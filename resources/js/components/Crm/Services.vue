<template>
  <v-card>
    <v-card-title>
      <v-btn @click="addServiceCategory = !addServiceCategory">
        Добавить категорию
      </v-btn>
    </v-card-title>
    <v-divider />
    <v-card-text>
      <v-list>
        <v-list-group v-for="(service, key) in services" :key="key"
                      value="true"
        >
          <template v-slot:activator>
            <v-list-item-title>
              {{ service.category.name }}
            </v-list-item-title>
          </template>
          <v-divider />
          <v-list-item v-for="(innerService,innerKey) in service.services" :key="innerKey" class="ml-10">
            {{ innerService.name }} <v-spacer /> {{ innerService.price }} руб. <v-spacer />
            <v-btn icon @click="editService(innerService)">
              <v-icon>mdi-pencil</v-icon>
            </v-btn>
            <v-btn icon @click="deleteService(innerService.serviceID)">
              <v-icon>mdi-delete</v-icon>
            </v-btn>
          </v-list-item>
          <v-list-item>
            <v-btn icon @click="editServiceCategory(service.category)">
              <v-icon>mdi-pencil</v-icon>
            </v-btn>
            <v-btn icon @click="deleteServiceCategory(service.category.id)">
              <v-icon>mdi-delete</v-icon>
            </v-btn>
            <v-spacer />
            <v-btn @click="addServiceToServer(service.category.id)">
              Добавить услугу
            </v-btn>
          </v-list-item>
        </v-list-group>
      </v-list>
    </v-card-text>
    <service-category-add v-model="addServiceCategory" />
    <service-add v-model="addService" :category="currentCategory" @update="getServices" />
    <service-edit v-model="editServiceModal" :service="dataService" @update="getServices" />
    <service-category-edit v-model="editServiceCategoryModal" :service-category="dataServiceCategory" @update="getServices" />
    <delete-window v-model="deleteModal" :block="deleteBlock" @update="getServices" />
  </v-card>
</template>

<script>
import ServiceAdd from './ServiceContent/ServiceAdd';
import ServiceCategoryAdd from './ServiceContent/ServiceCategoryAdd';
import ServiceEdit from './ServiceContent/ServiceEdit';
import ServiceCategoryEdit from './ServiceContent/ServiceCategoryEdit';
import DeleteWindow from '../Inputs/DeleteWindow';

export default {
  name: 'Services',
  components: { ServiceEdit, ServiceCategoryAdd, ServiceAdd, ServiceCategoryEdit, DeleteWindow },
  data: ()=>({
    currentCategory: 0,
    addService: false,
    addServiceCategory: false,
    editServiceModal: false,
    deleteModal: false,
    editServiceCategoryModal: false,
    deleteBlock: {},
    services: [],
    dataService: {},
    dataServiceCategory: {},
  }),
  async created() {
    this.getServices();

    // console.log( services);
  },
  methods: {
    addServiceToServer(categoryID) {
      this.currentCategory = categoryID;
      this.addService = !this.addService;
    },
    editService(data) {
      this.dataService = data;
      this.editServiceModal = true;
    },
    editServiceCategory(data) {
      this.dataServiceCategory = data;
      this.editServiceCategoryModal = true;
    },
    deleteService(id) {
      this.deleteBlock = {
        'id': id,
        'name': 'services',
      };
      this.deleteModal = true;
    },
    deleteServiceCategory(id) {
      this.deleteBlock = {
        'id': id,
        'name': 'services/category',
      };
      this.deleteModal = true;
    },
    async getServices() {
      const bidsData = await this.$http.get(`${this.$host}/services/`);
      this.services = bidsData.data;
      this.services.forEach((item)=>{
        item.services.forEach((service) => service.edit = false);
      });
    },
  },
};
</script>

<style>

</style>
