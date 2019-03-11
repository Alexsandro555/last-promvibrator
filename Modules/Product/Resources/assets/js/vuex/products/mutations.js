import { PRIVATE } from "@/constants";

export default {
    [PRIVATE.SET_ATTRIBUTES]: (state, payload) => {
      state.attributes = payload
    }
}
