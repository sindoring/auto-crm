<template>
  <v-dialog v-model="$active"
            max-width="600"
  >
    <v-card>
      <v-card-title class="justify-center">
        <h3 class="text-center">
          Заявка от {{ bid.date }}
        </h3>
      </v-card-title>
      <v-card-text>
        <v-col cols="12">
          <service-select v-model="bid.serviceData" />
        </v-col>
        <v-col cols="12">
          <bid-status-select v-model="bid.statusData" />
        </v-col>
        <v-col v-if="permission=='admin'" cols="12">
          <employee-select v-model="bid.employeeData" />
        </v-col>
        <v-col cols="12">
          <client-select v-model="bid.clientData" />
        </v-col>
        <v-col cols="12">
          <cars-select v-model="bid.car" />
        </v-col>
        <v-col cols="12">
          <v-menu
            ref="menu"
            v-model="menu"
            :close-on-content-click="false"
            :return-value.sync="bid.client.date"
            transition="scale-transition"
            offset-y
            min-width="290px"
          >
            <template v-slot:activator="{ on }">
              <v-text-field
                v-model="bid.client.date"
                label="Выберите дату"
                readonly
                v-on="on"
              />
            </template>
            <v-date-picker v-model="bid.client.date" no-title scrollable locale="RU">
              <v-spacer />
              <v-btn text color="primary" @click="menu = false">
                Отмена
              </v-btn>
              <v-btn text color="primary" @click="$refs.menu.save(bid.client.date)">
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
            :return-value.sync="bid.time"
            transition="scale-transition"
            offset-y
            max-width="290px"
            min-width="290px"
          >
            <template v-slot:activator="{ on }">
              <v-text-field
                v-model="bid.time"
                label="Выберите время"
                readonly
                v-on="on"
              />
            </template>
            <v-time-picker
              v-if="menuTime"
              v-model="bid.time"
              format="24hr"
              full-width
              @click:minute="$refs.menu2.save(bid.time)"
            />
          </v-menu>
        </v-col>
        <v-col cols="12">
          <v-text-field v-model="bid.duration" label="Введите продолжительность" />
        </v-col>
        <v-col cols="12">
          <v-textarea v-model="bid.client.comment" label="Введите комментари" />
        </v-col>
      </v-card-text>
      <v-divider />
      <v-card-actions>
        <v-btn @click="$active = !$active">
          Отмена
        </v-btn>
        <v-spacer />
        <v-btn @click="bidEdit">
          Сохранить
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
import BidStatusSelect from '../../Inputs/BidStatusSelect';
export default {
  name: 'BidEdit',
  components: { CarsSelect, EmployeeSelect, ServiceSelect, BidStatusSelect, ClientSelect },
  props: {
    value: {
      type: Boolean,
      default: false,
    },
    bid: {
      type: [Object, String],
      default: '',
    },
  },
  data() {
    return {
      date: '',
      menu: false,
      menuTime: false,
      formData: {},
      deleteBid: false,
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
  created() {
    console.log(this.bid);
  },
  methods: {
    async bidEdit() {
      const formData = new FormData();

      formData.append('bidID', this.bid.bidID);
      formData.append('clientID', this.bid.clientData.clientID);
      formData.append('serviceID', this.bid.serviceData.serviceID);
      if (this.$permission == 'admin') {
        formData.append('employeeID', this.bid.employee.employeeID);
      }
      formData.append('carID', this.bid.car.carID);
      formData.append('datetime', this.bid.date);
      formData.append('time', this.bid.time);
      formData.append('type', this.bid.statusData.value);
      formData.append('duration', this.bid.duration);
      formData.append('comment', this.bid.comment);

      await this.$http.post(`${this.$host}/bids/edit`, formData);
      this.$emit('update');
      this.$active = false;
    },
  },

};
</script>

<style>

</style>
