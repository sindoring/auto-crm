<template>
  <v-card>
    <v-row>
      <v-col>
        <v-list-item three-line>
          <v-list-item-content>
            <div class="overline mb-4">
              {{ bid.date }}
            </div>
            <v-list-item-title class="headline mb-1">
              {{ bid.title }}
            </v-list-item-title>
            <v-list-item-subtitle>Сотрудник: {{ bid.employee }}</v-list-item-subtitle>
            <v-list-item-subtitle>
              <v-chip :color="typeColor">
                {{ typeName }}
              </v-chip>
            </v-list-item-subtitle>
            <v-list-item-title>
              Цена: {{ bid.price }}
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-card-actions>
          <v-btn text @click="bidEdit = !bidEdit">
            Редактировать
          </v-btn>
          <v-btn color="error" text @click="deleteBid = !deleteBid">
            Удалить
          </v-btn>
        </v-card-actions>
      </v-col>
      <v-divider vertical />
      <v-col>
        <v-list-item three-line>
          <v-list-item-content>
            <v-list-item-title class="headline mb-1">
              Клиент: {{ bid.client.name }}
            </v-list-item-title>
            <v-list-item-subtitle>
              Email: {{ bid.client.email }}
            </v-list-item-subtitle>
            <v-list-item-subtitle>
              Телефон: {{ bid.client.phone }}
            </v-list-item-subtitle>
            <v-list-item-subtitle>
              Записан на: {{ bid.client.date }}
            </v-list-item-subtitle>
            <v-list-item-subtitle>
              Комментарий: {{ bid.client.comment }}
            </v-list-item-subtitle>
            <v-list-item-subtitle v-if="bid.client.car">
              Автомобиль: {{ bid.client.car }}
            </v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
      </v-col>
    </v-row>
    <bid-edit v-model="bidEdit" :bid="bid" @update="updateBids" />

    <delete-window
      v-model="deleteBid"
      :block="{
        name: 'bids',
        id: bid.bidID
      }"
      @update="$emit('update')"
    />
  </v-card>
</template>

<script>
import BidEdit from './BidEdit';
import DeleteWindow from '../../Inputs/DeleteWindow';


export default {
  name: 'BidCard',
  components: { BidEdit, DeleteWindow },
  props: {
    bid: {
      type: [Object, String],
      default: '',
    },
  },
  data: ()=>({
    bidEdit: false,
    deleteBid: false,
  }),
  computed: {
    typeColor() {
      let color = '';
      if (this.bid.status == 'progress') {
        color = 'yellow';
      }
      if (this.bid.status == 'ready') {
        color = 'success';
      }
      if (this.bid.status == 'denied') {
        color = 'error';
      }
      return color;
    },
    typeName() {
      let name = '';
      if (this.bid.status == 'progress') {
        name = 'В работе';
      }
      if (this.bid.status == 'ready') {
        name = 'Выполнена';
      }
      if (this.bid.status == 'denied') {
        name = 'Отменена';
      }
      return name;
    },
  },
  methods: {
    updateBids() {
      this.$emit('update');
    },
  },
};
</script>

<style>

</style>
