<template>
  <v-dialog v-model="$active"
            max-width="600"
  >
    <v-card>
      <v-card-title class="justify-center">
        <h3 class="text-center">
          Новый клиент
        </h3>
      </v-card-title>
      <v-card-text>
        <v-col cols="12">
          <v-text-field v-model="formData.name" label="Введите имя клиента" />
        </v-col>
        <v-col cols="12">
          <v-text-field v-model="formData.email" label="Введите E-mail клиента" />
        </v-col>
        <v-col cols="12">
          <phone-input v-model="formData.phone" label="Введите телефон клиента" />
        </v-col>
        <v-col cols="12">
          <cars-select v-model="formData.car" label="Введите автомобиль клиента" />
        </v-col>
      </v-card-text>
      <v-card-actions>
        <v-btn @click="$active = false">
          Отмена
        </v-btn>
        <v-spacer />
        <v-btn @click="addClient">
          Добавить
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import PhoneInput from '../../Inputs/PhoneInput';
import CarsSelect from '../../Inputs/CarsSelect';

export default {
  name: 'LoginModal',
  components: { PhoneInput, CarsSelect },
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
      services: [
        {
          title: 'Ремонт двигателя',
        },
        {
          title: 'Ремонт АКПП',
        },
        {
          title: 'Ремонт ходовой',
        },
        {
          title: 'Замена масла',
        },
      ],
      clients: [
        {
          title: 'Блажевич Игорь Юрьевич',
        },
        {
          title: 'Валиева Руфина Рафаэлевна',
        },
        {
          title: 'Возвышаев Александр Андреевич',
        },
        {
          title: 'Гриненко Алексей Алексеевич',
        },
      ],
      cars: [
        {
          title: 'Chevrolet Lacetti',
        },
        {
          title: 'BMW X6',
        },
        {
          title: 'Lada 2110',
        },
      ],
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
    async addClient() {
      const formData = new FormData();

      formData.append('name', this.formData.name);
      formData.append('email', this.formData.email);
      formData.append('phone', this.formData.phone);
      formData.append('carID', this.formData.car.carID);

      await this.$http.post(`${this.$host}/clients`, formData);
      this.$emit('update');
      this.$active = false;
    },
  },

};
</script>

<style>

</style>
