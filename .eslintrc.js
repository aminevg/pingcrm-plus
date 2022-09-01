module.exports = {
    env: {
        node: true,
        "vue/setup-compiler-macros": true,
    },
    extends: [
        "eslint:recommended",
        "plugin:vue/vue3-recommended",
        "@vue/eslint-config-typescript/recommended",
        "prettier",
    ],
    rules: {
        "vue/no-setup-props-destructure": "off",
    },
    globals: {
        route: true,
    },
};
