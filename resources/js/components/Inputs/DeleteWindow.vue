<template>
  <v-dialog v-model="$active" persistent max-width="290">
    <v-card>
      <v-card-text class="headline">
        После удаления все сопутствующие данные будут уничтожены
      </v-card-text>
      <v-card-actions>
        <v-spacer />
        <v-btn @click="$active = false">
          Отмена
        </v-btn>
        <v-btn color="error" @click="deleteDataInBlock">
          Удалить
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  name: 'DeleteWindow',
  props: {
    value: {
      type: Boolean,
      default: false,
    },
    block: {
      type: Object,
      default: ()=>({}),
    },
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
    console.log(this.block);
  },
  methods: {
    async deleteDataInBlock() {
      await this.$http.post(`${this.$host}/${this.block.name}/delete`, { id: this.block.id });
      this.$emit('update');
      this.$active = false;
    },
  },
};
</script>

<style>

</style>
