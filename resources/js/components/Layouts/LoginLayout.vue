<template>
  <v-app id="inspire">
    <v-content>
      <v-container
        class="fill-height"
        fluid
      >
        <v-row
          align="center"
          justify="center"
        >
          <v-col
            cols="12"
            sm="8"
            md="4"
          >
            <form action="login" method="post">
              <crfs-token-input />
              <v-card class="elevation-12">
                <v-toolbar
                  color="primary"
                  dark
                  flat
                >
                  <v-toolbar-title> ООО "СТО" </v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                  <phone-input v-model="formData.phone" name="phone" />

                  <v-text-field
                    id="password"
                    v-model="formData.password"
                    name="password"
                    label="Пароль"
                    type="password"
                  />
                </v-card-text>
                <v-card-actions>
                  <v-spacer />
                  <v-btn type="submit" color="primary">
                    Войти
                  </v-btn>
                </v-card-actions>
              </v-card>
            </form>
          </v-col>
        </v-row>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
import PhoneInput from '../Inputs/PhoneInput';
import CrfsTokenInput from '../Landing/CrfsTokenInput';

export default {
  name: 'CrmLayout',
  components: { PhoneInput, CrfsTokenInput },
  data: ()=>({
    formData: {},
  }),
  methods: {
    login() {

    },
  },
};
</script>

<style>

</style>
