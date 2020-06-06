<template>
  <v-col cols="12">
    <v-card>
      <v-card-title> {{ employee.name }} <v-spacer /> Оказанные услуги</v-card-title>
      <v-card-text>
        <v-row>
          <v-col cols="6">
            <v-list>
              <v-list-item>
                Роль: {{ employee.role }}
              </v-list-item>
              <v-list-item>
                Телефон: {{ employee.phone }}
              </v-list-item>
              <v-list-item>
                Заявок: {{ employee.bids }}
              </v-list-item>
              <v-list-item>
                <v-chip color="success">
                  Завершено: {{ employee.complete }}
                </v-chip>
                <v-chip color="yellow">
                  В работе: {{ employee.progress }}
                </v-chip>
                <v-chip color="error">
                  Отменено: {{ employee.denied }}
                </v-chip>
              </v-list-item>
            </v-list>
          </v-col>
          <v-divider vertical />
          <v-col cols="5.5">
            <v-simple-table v-if="employee.services.list.length>0">
              <template v-slot:default>
                <thead>
                  <tr>
                    <th class="text-left">
                      Дата
                    </th>
                    <th class="text-left">
                      Услуга
                    </th>
                    <th class="text-left">
                      Цена
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(service, key) in employee.services.list" :key="key">
                    <td>{{ service.date }}</td>
                    <td>{{ service.name }}</td>
                    <td>{{ service.price }}</td>
                  </tr>
                  <tr>
                    <td />
                    <td>Оказано услуг на:</td>
                    <td>{{ employee.services.total }} ₽</td>
                  </tr>
                </tbody>
              </template>
            </v-simple-table>
            <v-card-title v-else style="font-size: 1em">
              Список законченных услуг пуст
            </v-card-title>
          </v-col>
        </v-row>
      </v-card-text>
      <v-card-actions>
        <v-btn @click="employeeEdit = !employeeEdit">
          Редактировать
        </v-btn>
        <v-btn color="error" @click="employeeDelete = !employeeDelete">
          Удалить
        </v-btn>
      </v-card-actions>
    </v-card>
    <employee-edit v-model="employeeEdit" :employee="employee" @update="updateEmployeeList" />
    <delete-window v-model="employeeDelete"
                   :block="{
                     'id': employee.employeeID,
                     'name': 'employees'
                   }"
                   @update="updateEmployeeList"
    />
  </v-col>
</template>

<script>
import EmployeeEdit from './EmployeeEdit';
import DeleteWindow from '../../Inputs/DeleteWindow';

export default {
  name: 'EmployeeCard',
  components: { EmployeeEdit, DeleteWindow },
  props: {
    employee: {
      type: [Object, String],
      default: '',
    },
  },
  data: ()=>({
    employeeEdit: false,
    employeeDelete: false,
  }),
  created() {
    console.log(this.employee);
  },
  methods: {
    updateEmployeeList() {
      this.$emit('update');
    },
  },
};
</script>

<style>

</style>
