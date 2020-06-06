<template>
  <v-dialog v-model="$active"
            max-width="600"
  >
    <v-card>
      <v-card-title class="justify-center">
        <h3 class="text-center">
          Новая услуга
        </h3>
      </v-card-title>
      <v-card-text>
        <v-col cols="12">
          <v-text-field v-model="formData.name" label="Введите название услугу" />
        </v-col>
        <v-col cols="12">
          <v-text-field v-model="formData.price" label="Введите цену" />
        </v-col>
      </v-card-text>
      <v-card-actions>
        <v-btn @click="$active = false">
          Отмена
        </v-btn>
        <v-spacer />
        <v-btn @click="newService">
          Добавить
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>

export default {
  name: 'ServiceAdd',
  props: {
    value: {
      type: Boolean,
      default: false,
    },
    category: {
      type: Number,
      default: 0,
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
    async newService() {
      this.formData.categoryID = this.category;

      await this.$http.post(`${this.$host}/services`, this.formData);

      this.$emit('update');
      this.$active = false;
    },
  },


};
</script>

<style>

</style>
