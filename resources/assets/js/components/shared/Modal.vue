<template>
    <transition name="modal-fade">
        <div v-if="showModal" class="modal-backdrop">
            <div role="dialog" class="modal show" :aria-labelledby="getModalTitleID">
                <div role="document" class="modal-dialog">
                    <div class="modal-content">
                          <div class="modal-header">
                            <h2 class="modal-title" :id="getModalTitleID">
                                <slot name="header"></slot>
                            </h2>

                            <button v-if="canDismiss" type="button" class="close" aria-label="Close modal" @click.prevent="$emit('closeModal')">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <slot name="body"></slot>
                        </div>

                        <div class="modal-footer">
                            <slot name="footer"></slot>
                        </div>
                    </div>
                </div>

                <div v-if="canDismiss" class="modal-dismiss-backdrop" @click.prevent="$emit('closeModal')"></div>
            </div>
        </div>
    </transition>
</template>

<script>
    import {generateRandomString} from '../../utilities/helpers';

    export default {
        name: 'modal',
        props: {
            showModal: {
                type: Boolean,
                default: false
            },
            canDismiss: {
                type: Boolean,
                default: true
            }
        },
        computed: {
            getModalTitleID() {
                return `modal-title-${generateRandomString()}`;
            }
        },
        methods: {
            handleEscapeKey(event) {
                if (this.canDismiss && event.key === 'Escape') {
                    this.$emit('closeModal');
                }
            }
        },
        mounted() {
            window.addEventListener('keyup', this.handleEscapeKey);
        },
        destroyed() {
            window.removeEventListener('keyup', this.handleEscapeKey);
        }
    }
</script>

<style scoped>
    .modal-backdrop {
        background: rgba(0, 0, 0, .5);
    }
    .modal-dismiss-backdrop {
        position: absolute;
        z-index: 1;
        width: 100vw;
        height: 100vh;
    }
    .modal-dialog {
        margin-top: 0;
        z-index: 3;
        top: 40vh;
        transform: translateY(-50%);
        transition: transform 125ms 25ms ease;
    }
    .modal-title {
        font-size: 1.875rem;
    }
    .modal-fade-enter,
    .modal-fade-leave-active {
        opacity: 0;
    }
    .modal-fade-enter .modal-dialog,
    .modal-fade-leave-active .modal-dialog {
        transform: translateY(0);
    }
    .modal-fade-enter-active,
    .modal-fade-leave-active {
        transition: opacity 150ms;
    }
</style>

