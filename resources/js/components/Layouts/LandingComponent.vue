<template>
  <v-app>
    <v-content>
      <v-app-bar app
                 inverted-scroll
      >
        <v-toolbar-title>CRM</v-toolbar-title>
        <v-spacer />
        <v-btn rounded @click="openLoginModal">
          Вход
        </v-btn>
      </v-app-bar>

      <div class="firstback">
        <div class="header">
          <div>CRM</div>
          <v-spacer />
          <v-btn rounded @click="openLoginModal">
            Вход
          </v-btn>
        </div>
        <div class="section-first mb-10">
          <v-container>
            <v-row align="center" class="justify-center">
              <v-col cols="6" class="px-2">
                <h1 class="text-left mb-5">
                  Лучшая CRM для Вашей мастерской
                </h1>
                <div class="text-left mb-10">
                  Продавать больше поможем мы:
                  удобная организация работы с сотрудниками и клиентами, все услуги в одном месте.
                  Не важно, гаражный мастер или крупное СТО.
                </div>
                <v-btn rounded class="btn-lg" @click="openRegistrationModal">
                  Получить бесплатно
                </v-btn>
              </v-col>
              <v-col cols="6" justify-center>
                <img class="mt-10" src="http://auto-crm-project/images/workers.svg">
                <div class="text-right">
                  <a class="author" href="http://www.freepik.com">Designed by macrovector / Freepik</a>
                </div>
              </v-col>
            </v-row>
          </v-container>
        </div>
      </div>

      <v-container>
        <div class="section">
          <h2 class="text-center mb-10">
            Преимущества
          </h2>
          <v-row>
            <v-col class="text-center">
              <img class="image mb-5" src="http://auto-crm-project/images/analythic.svg" alt="">
              <h3>Аналитика</h3>
            </v-col>
            <v-col class="text-center">
              <img class="image mb-5" src="http://auto-crm-project/images/employees.svg" alt="">
              <h3>Управление сотрудниками</h3>
            </v-col>
            <v-col class="text-center">
              <img class="image mb-5" src="http://auto-crm-project/images/services.svg" alt="">
              <h3>Все услуги в одном месте</h3>
            </v-col>
          </v-row>
        </div>
      </v-container>
    </v-content>
    <registration-modal v-model="register" />
    <login-modal v-model="login" />
  </v-app>
</template>

<script>

import RegistrationModal from '../Landing/RegistrationModal';
import LoginModal from '../Landing/LoginModal';

export default {
  name: 'LandingComponent',
  components: { RegistrationModal, LoginModal },
  data: ()=>{
    return {
      register: false,
      login: false,
    };
  },
  methods: {
    openRegistrationModal() {
      this.register = !this.register;
    },
    openLoginModal() {
      this.login = !this.login;
    },
  },
};
</script>

<style lang="scss" scoped>

    $background-color: #F1F1F2;

    .author{
        font-size: 14px;
    }

    .image{
        width: 150px;
        height: 150px;
    }

    .section {
        display: block;
        position: relative;
        .title{
            text-align: center;
        }
        &-first{
            height: 90vh;
            padding: 5em 0;
            font-size: 22px;
        }
    }
    .firstback{
            background-image: url('http://auto-crm-project/images/background.jpg');
            background-position-y: -120px;
            background-size: cover;
    }

</style>
