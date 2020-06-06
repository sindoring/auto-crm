<template>
  <v-combobox v-model="$bidStatus"
              :items="statuses"
              item-text="text"
              label="Выберите статус заявки"
  />
</template>
<script>

export default {
  name: 'BidStatus',
  props: {
    'value': {
      type: [Object, String],
      default: '',
    },
  },
  data: ()=>({
    statuses: [{
      value: 'denied',
      text: 'Отменена',
    },
    {
      value: 'progress',
      text: 'В работе',
    },
    {
      value: 'ready',
      text: 'Готова',
    }],
  }),
  computed: {
    $bidStatus: {
      get() {
        return this.value;
      },
      set(value) {
        this.$emit('input', value);
      },
    },
  },
};
</script>
