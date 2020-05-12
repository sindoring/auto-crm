<template>
  <v-dialog v-model="$activate"
            max-width="600"
  >
    <v-stepper v-model="e1">
      <v-stepper-header>
        <v-stepper-step :complete="e1 > 1" step="1">
          Введите телефон
        </v-stepper-step>

        <v-divider />

        <v-stepper-step :complete="e1 > 2" step="2">
          Введите пароль
        </v-stepper-step>

        <v-divider />

        <v-stepper-step step="3">
          Готово!
        </v-stepper-step>
      </v-stepper-header>

      <v-stepper-items>
        <v-stepper-content step="1">
          <phone-input v-model="formData.phone" />
          <v-btn rounded
                 color="primary"
                 @click="e1 = 2"
          >
            Далее
          </v-btn>

          <v-btn text>
            Отмена
          </v-btn>
        </v-stepper-content>

        <v-stepper-content step="2">
          <v-btn rounded
                 color="primary"
                 @click="e1 = 3"
          >
            Далее
          </v-btn>

          <v-btn text>
            Отмена
          </v-btn>
        </v-stepper-content>

        <v-stepper-content step="3" justify-contnet="center" mix-height="400">
          <v-btn rounded>
            Перейти в личный кабинет
          </v-btn>
        </v-stepper-content>
      </v-stepper-items>
    </v-stepper>
  </v-dialog>
</template>

<script>
import PhoneInput from '../Inputs/PhoneInput';

export default {
  name: 'LoginModal',
  components: { PhoneInput },
  props: {
    value: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      formData: {},
      e1: 1,
    };
  },
  computed: {
    $activate: {
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
