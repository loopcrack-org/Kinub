import intlTelInput from 'intl-tel-input';

export default function createIntTelInput(phoneInputField) {
  return intlTelInput(phoneInputField, {
    preferredCountries: ['mx'],
    utilsScript: require('intl-tel-input/build/js/utils.js'),
  });
}
