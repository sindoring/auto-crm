<template>
  <v-dialog v-model="$active"
            max-width="600"
  >
    <v-card>
      <v-card-title class="justify-center">
        <h3 class="text-center">
          Редактирование
        </h3>
      </v-card-title>
      <v-card-text>
        <v-col cols="12">
          <v-text-field v-model="employee.name" label="Введите имя сотрудника" />
        </v-col>
        <v-col cols="12">
          <v-text-field v-model="employee.role" label="Введите роль сотрудника" />
        </v-col>
        <v-col cols="12">
          <phone-input v-model="employee.phone" label="Введите телефон сотрудника" />
        </v-col>
        <v-col cols="12">
          <v-text-field v-model="employee.password" type="password" label="Введите пароль для сотрудника" />
        </v-col>
      </v-card-text>
      <v-card-actions>
        <v-btn @click="$active = false">
          Отмена
        </v-btn>
        <v-spacer />
        <v-btn @click="editEmployee">
          Готово
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import PhoneInput from '../../Inputs/PhoneInput';

export default {
  name: 'EmployeeEdit',
  components: { PhoneInput },
  props: {
    value: {
      type: Boolean,
      default: false,
    },
    employee: {
      type: [Object, String],
      default: '',
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
    async editEmployee() {
      const formData = new FormData();

      formData.append('employeeID', this.employee.employeeID);
      formData.append('name', this.employee.name);
      formData.append('phone', this.employee.phone);
      formData.append('roleName', this.employee.role);
      formData.append('password', this.employee.password);

      await this.$http.post(`${this.$host}/employees/edit`, formData);
      this.$emit('update');
      this.$active = false;
    },
  },

};
</script>

<style>

</style>
