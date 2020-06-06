<template>
  <v-col cols="12">
    <v-card>
      <v-card-title> {{ client.title }} </v-card-title>
      <v-card-text>
        <v-list>
          <v-list-item>
            E-mail: {{ client.data.email }}
          </v-list-item>
          <v-list-item>
            Телефон: {{ client.data.phone }}
          </v-list-item>
          <v-list-item>
            Автомобиль: {{ client.data.car.carName }}
          </v-list-item>
        </v-list>
      </v-card-text>
      <v-card-actions>
        <v-btn @click="clientEdit = !clientEdit">
          Редактировать
        </v-btn>
        <v-btn color="error" @click="clientDelete = !clientDelete">
          Удалить
        </v-btn>
      </v-card-actions>
    </v-card>
    <client-edit v-model="clientEdit" :client="client" @update="updateClients" />
    <delete-window
      v-model="clientDelete"
      :block="{
        name: 'clients',
        id: client.clientID
      }"
      @update="$emit('update')"
    />
  </v-col>
</template>

<script>
import ClientEdit from './ClientEdit';
import DeleteWindow from '../../Inputs/DeleteWindow';

export default {
  name: 'ClientCard',
  components: { ClientEdit, DeleteWindow },
  props: {
    client: {
      type: [Object, String],
      default: '',
    },
  },
  data: ()=>({
    clientEdit: false,
    clientDelete: false,
  }),
  methods: {
    updateClients() {
      this.$emit('update');
    },
  },
};
</script>

<style>

</style>
