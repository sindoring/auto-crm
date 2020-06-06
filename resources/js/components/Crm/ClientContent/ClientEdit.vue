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
          <v-text-field v-model="client.title" label="Введите имя клиента" />
        </v-col>
        <v-col cols="12">
          <v-text-field v-model="client.data.email" label="Введите E-mail клиента" />
        </v-col>
        <v-col cols="12">
          <phone-input v-model="client.data.phone" label="Введите телефон клиента" />
        </v-col>
        <v-col cols="12">
          <cars-select
            v-model="client.data.car"
          />
        </v-col>
      </v-card-text>
      <v-card-actions>
        <v-btn @click="$active = false">
          Отмена
        </v-btn>
        <v-spacer />
        <v-btn @click="editClient">
          Готово
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import CarsSelect from '../../Inputs/CarsSelect';
import PhoneInput from '../../Inputs/PhoneInput';

export default {
  name: 'ClientEdit',
  components: { CarsSelect, PhoneInput },
  props: {
    value: {
      type: Boolean,
      default: false,
    },
    client: {
      type: [Object, String],
      default: '',
    },
  },
  data() {
    return {
      formData: {},
      date: '',
      menu: false,
      services: [],
      clients: [],
      cars: [],
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
    async editClient() {
      const formData = new FormData();

      formData.append('clientID', this.client.clientID);
      formData.append('name', this.client.title);
      formData.append('phone', this.client.data.phone);
      formData.append('email', this.client.data.email);
      formData.append('carID', this.client.data.car.carID);

      await this.$http.post(`${this.$host}/clients/edit`, formData);

      this.$emit('update');
      this.$active = false;
    },
  },
};
</script>

<style>

</style>
