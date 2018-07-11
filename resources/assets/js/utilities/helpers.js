const possibleStringCharacters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

const generateRandomString = (
    strLength = 10
) => {
    const chars = [];
    for (let i = 0; i <= strLength; i++) {
        chars.push(
            possibleStringCharacters.charAt(
                Math.floor(Math.random() * possibleStringCharacters.length)
            )
        );
    }
    return chars.join('');
}

export {
    generateRandomString
};
