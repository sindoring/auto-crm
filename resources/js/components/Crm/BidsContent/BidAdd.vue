<template>
  <v-dialog v-model="$active"
            max-width="600"
  >
    <v-card>
      <v-card-title class="justify-center">
        <h3 class="text-center">
          Новая заявка
        </h3>
      </v-card-title>
      <v-card-text>
        <v-col cols="12">
          <service-select v-model="formData.service" />
        </v-col>
        <v-col v-if="permission=='admin'" cols="12">
          <employee-select v-model="formData.employee" />
        </v-col>
        <v-col cols="12">
          <client-select v-model="formData.client" />
        </v-col>
        <v-col cols="12">
          <cars-select v-model="formData.car" />
        </v-col>
        <v-col cols="12">
          <v-menu
            ref="menu"
            v-model="menu"
            :close-on-content-click="false"
            :return-value.sync="formData.date"
            transition="scale-transition"
            offset-y
            min-width="290px"
          >
            <template v-slot:activator="{ on }">
              <v-text-field
                v-model="formData.date"
                label="Выберите дату"
                readonly
                v-on="on"
              />
            </template>
            <v-date-picker v-model="date" no-title scrollable locale="RU">
              <v-spacer />
              <v-btn text color="primary" @click="menu = false">
                Отмена
              </v-btn>
              <v-btn text color="primary" @click="$refs.menu.save(date)">
                Выбрать
              </v-btn>
            </v-date-picker>
          </v-menu>
        </v-col>
        <v-col cols="12">
          <v-menu
            ref="menu2"
            v-model="menuTime"
            :close-on-content-click="false"
            :nudge-right="40"
            :return-value.sync="formData.time"
            transition="scale-transition"
            offset-y
            max-width="290px"
            min-width="290px"
          >
            <template v-slot:activator="{ on }">
              <v-text-field
                v-model="formData.time"
                label="Выберите время"
                readonly
                v-on="on"
              />
            </template>
            <v-time-picker
              v-if="menuTime"
              v-model="formData.time"
              format="24hr"
              full-width
              @click:minute="$refs.menu2.save(formData.time)"
            />
          </v-menu>
        </v-col>
        <v-col cols="12">
          <v-text-field v-model="formData.duration" label="Введите продолжительность" />
        </v-col>
        <v-col cols="12">
          <v-textarea v-model="formData.comment" label="Введите комментарий" />
        </v-col>
      </v-card-text>
      <v-card-actions>
        <v-btn @click="$active = false">
          Отмена
        </v-btn>
        <v-spacer />
        <v-btn @click="bidAdd">
          Добавить
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import CarsSelect from '../../Inputs/CarsSelect';
import ClientSelect from '../../Inputs/ClientSelect';
import EmployeeSelect from '../../Inputs/EmployeesSelect';
import ServiceSelect from '../../Inputs/ServiceSelect';

export default {
  name: 'BidAdd',
  components: { CarsSelect, EmployeeSelect, ServiceSelect, ClientSelect },
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
      menuTime: false,
      permission: this.$permission,
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
    async bidAdd() {
      console.log(this.formData);

      const formData = new FormData();

      formData.append('clientID', this.formData.client.clientID);
      formData.append('serviceID', this.formData.service.serviceID);
      if (this.$permission == 'admin') {
        formData.append('employeeID', this.formData.employee.employeeID);
      }
      formData.append('carID', this.formData.car.carID);
      formData.append('datetime', this.formData.date);
      formData.append('time', this.formData.time);
      formData.append('duration', this.formData.duration);
      formData.append('comment', this.formData.comment);

      await this.$http.post(`${this.$host}/bids`, formData);
      this.$emit('update');
      this.$active = false;
    },
  },

};
</script>

<style>

</style>
