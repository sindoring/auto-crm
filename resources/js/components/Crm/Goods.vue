<template>
  <v-card>
    <v-card-title>
      <v-btn @click="addGoodCategoryModal = !addGoodCategoryModal">
        Добавить категорию товара
      </v-btn>
    </v-card-title>
    <v-divider />
    <v-card-text>
      <v-list>
        <v-list-group v-for="(good, key) in goods" :key="key"
                      value="true"
        >
          <template v-slot:activator>
            <v-list-item-title>
              {{ good.category.name }}
            </v-list-item-title>
          </template>
          <v-divider />
          <v-list-item v-for="(innerGood,innerKey) in good.goods" :key="innerKey" class="ml-10">
            {{ innerGood.name }} x{{ innerGood.count }} <v-spacer /> {{ innerGood.price }} руб. <v-spacer />
            <v-btn icon @click="editGoodData(innerGood)">
              <v-icon>mdi-pencil</v-icon>
            </v-btn>
            <v-btn icon @click="deleteGood(innerGood.goodID)">
              <v-icon>mdi-delete</v-icon>
            </v-btn>
          </v-list-item>

          <v-list-item>
            <v-btn icon @click="editGoodCategory(good.category)">
              <v-icon>mdi-pencil</v-icon>
            </v-btn>
            <v-btn icon @click="deleteGoodCategory(good.category.id)">
              <v-icon>mdi-delete</v-icon>
            </v-btn>
            <v-spacer />
            <v-btn @click="addGoodToServer(good.category.id)">
              Добавить товар
            </v-btn>
          </v-list-item>
        </v-list-group>
      </v-list>
    </v-card-text>
    <good-category-add v-model="addGoodCategoryModal" @update="getGoods" />
    <good-category-edit v-model="editGoodCategoryModal" :good-category="dataGoodCategory" @update="getGoods" />
    <good-add v-model="addGoodModal" :category="currentCategory" @update="getGoods" />
    <good-edit v-model="editGoodModal" :good="dataGood" @update="getGoods" />
    <delete-window v-model="deleteModal" :block="deleteBlock" @update="getGoods" />
  </v-card>
</template>

<script>
import GoodAdd from './GoodsContent/GoodAdd';
import GoodCategoryAdd from './GoodsContent/GoodCategoryAdd';
import GoodEdit from './GoodsContent/GoodEdit';
import GoodCategoryEdit from './GoodsContent/GoodCategoryEdit';
import DeleteWindow from '../Inputs/DeleteWindow';

export default {
  name: 'Goods',
  components: { GoodAdd, GoodCategoryAdd, GoodEdit, GoodCategoryEdit, DeleteWindow },
  data: ()=>({
    addGoodModal: false,
    addGoodCategoryModal: false,
    editGoodModal: false,
    editGoodCategoryModal: false,
    deleteModal: false,
    currentCategory: 0,
    deleteBlock: {},
    dataGoodCategory: {},
    dataGood: {},
    goods: [],
  }),
  async created() {
    await this.getGoods();
  },
  methods: {
    addGoodToServer(categoryID) {
      this.currentCategory = categoryID;
      this.addGoodModal = !this.addGoodModal;
    },
    editGoodData(data) {
      this.dataGood = data;
      this.editGoodModal = true;
    },
    editGoodCategory(data) {
      this.dataGoodCategory = data;
      this.editGoodCategoryModal = true;
    },
    deleteGood(id) {
      this.deleteBlock = {
        'id': id,
        'name': 'goods',
      };
      this.deleteModal = true;
    },
    deleteGoodCategory(id) {
      this.deleteBlock = {
        'id': id,
        'name': 'goods/category',
      };
      this.deleteModal = true;
    },
    async getGoods() {
      const httpRequest = await this.$http.get(`${this.$host}/goods`);
      this.goods = httpRequest.data;
      this.goods.forEach((item)=>{
        item.goods.forEach((good) => good.edit = false);
      });
    },
  },
};
</script>

<style>

</style>
