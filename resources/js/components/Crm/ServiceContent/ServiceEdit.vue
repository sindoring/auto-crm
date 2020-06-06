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
          <v-text-field v-model="service.name" label="Введите название категории" />
        </v-col>
        <v-col cols="12">
          <v-text-field v-model="service.price" label="Введите цену" />
        </v-col>
      </v-card-text>
      <v-card-actions>
        <v-btn @click="$active = false">
          Отмена
        </v-btn>
        <v-spacer />
        <v-btn @click="editService">
          Готово
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>

export default {
  name: 'ServiceEdit',
  props: {
    value: {
      type: Boolean,
      default: false,
    },
    service: {
      type: [Object, String],
      default: '',
    },
  },
  data() {
    return {
      formData: {},
      date: '',
      menu: false,
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
    async editService() {
      const formData = new FormData();

      formData.append('serviceID', this.service.serviceID);
      formData.append('name', this.service.name);
      formData.append('price', this.service.price);

      await this.$http.post(`${this.$host}/services/edit`, formData);

      this.$emit('update');
      this.$active = false;
    },
  },

};
</script>

<style>

</style>
