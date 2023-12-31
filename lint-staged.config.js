module.exports = {
  '*.{ts,js}': ['prettier --write', 'eslint --fix'],
  '*.{html,md,xml,less,postcss,markdown,yml,yaml,json}': ['prettier --write'],
  '*.{css,scss,less}': ['prettier --write', 'stylelint --fix'],
  '*.php': ['vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php'],
};
