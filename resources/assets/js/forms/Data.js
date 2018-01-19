export default new Vue({

		data()
		{
			return {
				shared:{}
			}

		},
		methods:{
			setField(key,value)
			{
				this.$set(this.shared,key,value);
			}
		}

		

})
