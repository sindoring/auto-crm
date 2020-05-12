<template>
  <v-text-field v-model="$phone"
                v-mask="customTokens"
                label="Телефон"
                name="phone"
                type="tel"
  />
</template>
<script>
import { mask } from 'vue-the-mask';

export default {
  name: 'PhoneInput',
  directives: { mask },
  props: {
    value: {
      type: String,
      default: '',
    },
  },
  data: (vm) => ({
    customTokens: {
      mask: '+Y (###) ###-##-##',
      tokens: {
        'Y': {
          pattern: /\d/,
          transform: (v) => {
            if (v != '7') {
              if (v == '8') {
                return (v = '7');
              } else {
                return (v = `7${v}`);
              }
            } else {
              return v;
            }
          },
        },
        '#': { pattern: /\d/ },
      },
    },
  }),
  computed: {
    $phone: {
      get() {
        return this.value;
      },
      set(value) {
        this.$emit('input', value);
      },
    },
  },
};
</script>
