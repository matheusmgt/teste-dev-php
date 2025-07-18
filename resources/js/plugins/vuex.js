import { createStore } from 'vuex'
import user from '../../modules/user/index'
import supply from '../../modules/supply/index'

export default createStore({
  modules: {
    user,
    supply,
  },
})