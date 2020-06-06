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
          <v-text-field v-model="good.name" label="Введите название товара" />
        </v-col>
        <v-col cols="12">
          <v-text-field v-model="good.price" label="Введите цену" />
        </v-col>
        <v-col cols="12">
          <v-text-field v-model="good.count" type="number" label="Введите количество" />
        </v-col>
        <v-col cols="12">
          <v-text-field v-model="good.article" label="Введите артикль" />
        </v-col>
      </v-card-text>
      <v-card-actions>
        <v-btn @click="$active = false">
          Отмена
        </v-btn>
        <v-spacer />
        <v-btn @click="editGood">
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
    good: {
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
    async editGood() {
      const formData = new FormData();

      formData.append('goodID', this.good.goodID);
      formData.append('name', this.good.name);
      formData.append('price', this.good.price);
      formData.append('count', this.good.count);
      formData.append('article', this.good.article);

      await this.$http.post(`${this.$host}/goods/edit`, formData);

      this.$emit('update');
      this.$active = false;
    },
  },

};
</script>

<style>

</style>
