module.exports = {
  root: true,
  env: {
    browser: true,
    es2020: true,
  },
  extends: [
    'airbnb-base',
    'eslint:recommended',
    'plugin:vue/recommended',
  ],
  parserOptions: {
    ecmaVersion: 11,
    sourceType: 'module',
    parser: 'babel-eslint',
  },
  plugins: ['vue'],
  rules: {
    semi: ['error', 'never'],
    'no-console': process.env.NODE_ENV === 'production' ? 'warn' : 'off',
    'no-debugger': process.env.NODE_ENV === 'production' ? 'warn' : 'off',
    'import/no-unresolved': 'off',
    'vue/html-indent': ['error', 2, {
      attribute: 1,
      baseIndent: 1,
      closeBracket: 1,
      alignAttributesVertically: true,
      ignores: [],
    }],
    'max-len': ['error', { code: 300 }],
    'vue/max-len': ['error', {
      code: 120,
      template: 300,
    }],
    'import/no-extraneous-dependencies': 'off',
    'import/extensions': 'off',
    'no-param-reassign': 'off',
  },
  overrides: [
    {
      files: [
        '**/test/**/*.spec.{j,t}s?(x)',
      ],
      env: {
        jest: true,
      },
    },
  ],
}
