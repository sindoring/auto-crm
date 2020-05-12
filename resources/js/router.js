import Dashboard from './components/Crm/Dashboard.vue';
import UserSettings from './components/Crm/UserSettings';
import Services from './components/Crm/Services';
import Employees from './components/Crm/Employees';
import Goods from './components/Crm/Goods';
import Schedule from './components/Crm/Schedule';

const router = [
  {
    path: '/crm/dashboard',
    component: Dashboard,
    meta: { title: 'Дашборд', mdi: 'mdi-home' },
  },
  {
    path: '/crm/schedule',
    component: Schedule,
    meta: { title: 'Расписание', mdi: 'mdi-calendar' },
  },
  {
    path: '/crm/services',
    component: Services,
    meta: { title: 'Услуги', mdi: 'mdi-toolbox' },
  },
  {
    path: '/crm/employees',
    component: Employees,
    meta: { title: 'Сотрудники', mdi: 'mdi-account-group' },
  },
  {
    path: '/crm/goods',
    component: Goods,
    meta: { title: 'Товары', mdi: 'mdi-wrench' },
  },
  {
    path: '/crm/settings',
    component: UserSettings,
    meta: { title: 'Настройки', mdi: 'mdi-cog' },
  },
];

export default router;
