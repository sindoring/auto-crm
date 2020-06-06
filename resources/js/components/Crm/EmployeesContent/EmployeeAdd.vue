<template>
  <v-dialog v-model="$active"
            max-width="600"
  >
    <v-card>
      <v-card-title class="justify-center">
        <h3 class="text-center">
          Новый сотрудник
        </h3>
      </v-card-title>
      <v-card-text>
        <v-col cols="12">
          <v-text-field v-model="formData.name" label="Введите имя сотрудника" />
        </v-col>
        <v-col cols="12">
          <v-text-field v-model="formData.roleName" label="Введите роль сотрудника" />
        </v-col>
        <v-col cols="12">
          <phone-input v-model="formData.phone" label="Введите телефон сотрудника" />
        </v-col>
        <v-col cols="12">
          <v-text-field v-model="formData.password" type="password" label="Введите пароль для сотрудника" />
        </v-col>
      </v-card-text>
      <v-card-actions>
        <v-btn @click="$active = false">
          Отмена
        </v-btn>
        <v-spacer />
        <v-btn @click="addEmployee">
          Добавить
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import PhoneInput from '../../Inputs/PhoneInput';

export default {
  name: 'EmployeeAdd',
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
      date: '',
      menu: false,
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
    async addEmployee() {
      const httpRequest = await this.$http.post(`${this.$host}/employees`, this.formData);
      this.$emit('update');
      this.$active = false;
      console.log(httpRequest);
    },
  },

};
</script>

<style>

</style>
