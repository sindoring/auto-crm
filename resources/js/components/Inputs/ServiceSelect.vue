<template>
  <v-combobox v-model="$service"
              :items="services"
              item-text="serviceName"
              label="Выберите услугу"
  />
</template>
<script>

export default {
  name: 'ServiceSelect',
  props: {
    'value': {
      type: [Object, String],
      default: '',
    },
  },
  data: ()=>({
    services: [],
  }),
  computed: {
    $service: {
      get() {
        return this.value;
      },
      set(value) {
        this.$emit('input', value);
      },
    },
  },
  async created() {
    const httpRequest = await this.$http.get(`${this.$host}/list/services`);
    this.services = httpRequest.data;
  },
};
</script>
