<template>
  <v-dialog v-model="$active"
            max-width="600"
  >
    <v-card>
      <form method="post" action="http://auto-crm-project/login">
        <crfs-token-input />
        <v-card-title class="justify-center">
          <h3 class="text-center">
            Авторизация
          </h3>
        </v-card-title>
        <v-card-text>
          <v-col cols="12">
            <phone-input
              v-model="formData.phone" name="phone"
            />
            <!-- <v-text-field v-model="formData.phone" name="phone" label="Телефон" required /> -->
          </v-col>
          <v-col cols="12">
            <v-text-field v-model="formData.password" name="password" label="Пароль" type="password" required />
          </v-col>
        </v-card-text>
        <v-card-actions class="justify-center">
          <v-btn type="submit" large primary>
            Войти
          </v-btn>
        </v-card-actions>
      </form>
    </v-card>
  </v-dialog>
</template>

<script>
import CrfsTokenInput from '../Landing/CrfsTokenInput';
import PhoneInput from '../Inputs/PhoneInput';

export default {
  name: 'LoginModal',
  components: { CrfsTokenInput, PhoneInput },
  props: {
    value: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      formData: {},
    };
  },
  computed: {
    $active: {
      get() {
        return this.value;
      },
      set(value) {
        this.$emit('input', value);
      },
    },
  },
  methods: {
    async login(data) {
      const response = await this.$http.post('http://auto-crm-project/api/auth/login', {
        phone: data.phone,
        password: data.password,
      });
      console.log(response.data);
    },
  },

};
</script>

<style>

</style>
