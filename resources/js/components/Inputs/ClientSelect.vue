<template>
  <v-combobox v-model="$client"
              :items="clients"
              item-text="clientName"
              label="Выберите клиента"
  />
</template>
<script>

export default {
  name: 'ClientsSelect',
  props: {
    'value': {
      type: [Object, String],
      default: '',
    },
  },
  data: ()=>({
    clients: [],
  }),
  computed: {
    $client: {
      get() {
        return this.value;
      },
      set(value) {
        this.$emit('input', value);
      },
    },
  },
  async created() {
    const httpRequest = await this.$http.get(`${this.$host}/list/clients`);
    this.clients = httpRequest.data;
  },
};
</script>
