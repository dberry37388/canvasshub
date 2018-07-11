<template>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <a role="button" data-toggle="collapse" :href="'#collapse-' + elementId"
               :aria-expanded="!collapsed" :aria-controls="'collapse-' + elementId" :class="{ 'collapsed': collapsed }">
                <h2 title="Click to expand / collapse" role="tab" :id="elementId" class="panel-title">{{ header }}
                    <span class="pull-right chevron"></span></h2>
            </a>

            <div :id="'collapse-' + elementId" :class="'panel-collapse collapse' + (!collapsed ? 'in' : '')"
                 role="tabpanel" :aria-labelledby="elementId">
                <div class="panel-body has-top-border">
                    <slot></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'collapsing-group',
        props: {
            header: {
                type: String,
                default: ''
            },
            collapsed: {
                type: Boolean,
                default: true
            }
        },
        computed: {
            elementId() {
                return this.header.replace(/\s+/g, '-').toLowerCase();
            }
        }
    }
</script>

<style scoped>
    .panel-title {
       color: #000;
       margin: 0;
       padding: 20px;
    }

    .chevron:after {
       font-family: 'icomoon';
       content: "\e9dc";
    }

    .collapsed .chevron:after {
       font-family: 'icomoon';
       content: "\e9de";
    }
</style>
