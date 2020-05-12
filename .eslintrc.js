module.exports = {
  'env': {
    'browser': true,
    'es6': true,
  },
  'extends': [
    'plugin:vue/recommended',
    'google',
  ],
  'globals': {
    'Atomics': 'readonly',
    'SharedArrayBuffer': 'readonly',
  },
  'parserOptions': {
    'ecmaVersion': 2018,
    'sourceType': 'module',
  },
  'plugins': [
    'vue',
  ],
  'rules': {
    'quotes': ['error', 'single'],
    'semi': ['error', 'always'],
    'indent': ['error', 2],
    'no-multi-spaces': ['error'],
    'max-len': ["error", { "code": 120 }],
    'linebreak-style': [2, "windows"],
    "require-jsdoc": ["error", {
      "require": {
          "FunctionDeclaration": true,
          "MethodDefinition": true,
          "ClassDeclaration": false,
          "ArrowFunctionExpression": false,
          "FunctionExpression": false
      }
  }],
  "object-curly-spacing": ["error", "always"],
  "comma-dangle": ["error", "always-multiline"],
  "vue/html-closing-bracket-newline": "error",
  "vue/html-closing-bracket-spacing": "error",
  "vue/prop-name-casing": "error",
  "vue/max-attributes-per-line": "off"
  },
};
