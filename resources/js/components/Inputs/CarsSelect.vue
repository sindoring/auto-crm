<template>
  <v-combobox v-model="$carID"
              :items="cars"
              item-text="carName"
              label="Выберите автомобиль"
  />
</template>
<script>

export default {
  name: 'CarsSelect',
  props: {
    'value': {
      type: [Object, String],
      default: '',
    },
  },
  data: ()=>({
    cars: [],
  }),
  computed: {
    $carID: {
      get() {
        return this.value;
      },
      set(value) {
        console.log(value);

        this.$emit('input', value);
      },
    },
  },
  async created() {
    const httpRequest = await this.$http.get(`${this.$host}/list/cars`);
    this.cars = httpRequest.data;
  },
};
</script>
