module.exports = {
  env: {
    browser: true,
    es2021: true,
    node: true,
  },
  plugins: ['compat'],
  extends: ['eslint:recommended', 'plugin:compat/recommended', 'prettier'],
  overrides: [],
  parserOptions: {
    ecmaVersion: 'latest',
    sourceType: 'module',
  },
  rules: {
    indent: ['error', 2],
    quotes: ['error', 'single'],
    semi: ['error', 'always'],
    'no-unused-vars': ['error', { ignoreRestSiblings: true }],
  },
};
