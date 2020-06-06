<template>
  <v-card>
    <v-card-title>
      <v-btn @click="employeeAdd = !employeeAdd">
        Добавить сотрудника
      </v-btn>
    </v-card-title>
    <v-card-text v-if="employees.length>0">
      <employee-card v-for="(employee, key) in employees" :key="key" :employee="employee" @update="getEmployees" />
    </v-card-text>
    <v-card-text v-else>
      <v-card-title>Добавьте сотрудника</v-card-title>
    </v-card-text>
    <employee-add v-model="employeeAdd" @update="getEmployees" />
  </v-card>
</template>

<script>
import EmployeeCard from './EmployeesContent/EmployeeCard';
import EmployeeAdd from './EmployeesContent/EmployeeAdd';
export default {
  name: 'Employees',
  components: { EmployeeCard, EmployeeAdd },
  data: ()=>({
    employeeAdd: false,
    employees: [],
  }),
  async created() {
    await this.getEmployees();
  },
  methods: {
    async getEmployees() {
      const httpRequest = await this.$http.get(`${this.$host}/employees`);
      this.employees = httpRequest.data;
    },
  },
};
</script>

<style>

</style>
