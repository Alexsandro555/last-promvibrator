export default {
    CURRENT : (state, data) => {
        state.count = data.count;
        state.total = data.total;
    }
}