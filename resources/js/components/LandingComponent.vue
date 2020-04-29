<template>
    <v-app>
        <v-content>
            <v-app-bar app
                       inverted-scroll>
                <v-toolbar-title>CRM</v-toolbar-title>
                <v-spacer/>
                <v-btn>Вход</v-btn>
            </v-app-bar>

            <div class='header'>
                <div>CRM</div>
                <v-spacer></v-spacer>
                <v-btn>Вход</v-btn>
            </div>
            <v-container>
                <div class="section-first">
                    <h1 class="text-center mb-10">Лучшая CRM для Вашей мастерской</h1>
                    <v-row align="center" justify="space-between">
                        <v-col>
                            <div>asd</div>
                        </v-col>
                        <v-col>asd</v-col>
                    </v-row>
                </div>
                <div class="section">
                    <div class="left">
                        Left side
                    </div>
                    <div class="right">
                        Right side
                    </div>
                </div>
            </v-container>
        </v-content>
    </v-app>
</template>

<script>
    export default {
        name: "LandingComponent"
    }
</script>

<style lang="scss" scoped>
    .section{
        border: 1px solid black;
        display: block;
        padding: 6em 0;

        .title{
            text-align: center;
        }

        &-first{
            height: 90vh;

        }
    }

</style>
