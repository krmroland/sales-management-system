import BaseDataStructure from "../../BaseDataStructure"

export default class structure extends BaseDataStructure
{
	constructor()
	{

		super([
		{
			name:"name",
			label:"The Name of the of the rate eg hour for per hour , day for per day ,month for per month",

		},
		{
			name:"ammount",
			label:"The ammount paid per unit rate eg 14,000/= a night",
			min:0

		}])
	}
}