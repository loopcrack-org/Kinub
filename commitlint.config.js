module.exports = {
  rules: {
    'header-max-length': [2, 'always', 120],
    'header-min-length': [2, 'always', 10],
    'body-leading-blank': [2, 'always'],
    'subject-case': [
      2,
      'always',
      ['sentence-case', 'start-case', 'pascal-case', 'upper-case', 'lower-case'],
    ],
  },
};
