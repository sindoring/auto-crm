<template>
  <v-combobox v-model="$employee"
              :items="employees"
              item-text="employeeName"
              label="Выберите сотрудника"
  />
</template>
<script>

export default {
  name: 'EmployeeSelect',
  props: {
    'value': {
      type: [Object, String],
      default: '',
    },
  },
  data: ()=>({
    employees: [],
  }),
  computed: {
    $employee: {
      get() {
        return this.value;
      },
      set(value) {
        this.$emit('input', value);
      },
    },
  },
  async created() {
    const httpRequest = await this.$http.get(`${this.$host}/list/employees`);
    this.employees = httpRequest.data;
  },
};
</script>
