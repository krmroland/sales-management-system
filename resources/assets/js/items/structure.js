
import BaseDataStructure from "../BaseDataStructure"

class structure extends BaseDataStructure
{
	constructor()
	{
		super([
				{
					name:'name',
					label:'The name of the item'
				},
				{
					name:'category',
					options:window.company.categories.items,
					label:"Please select a category"
				},
			
				{
					name:"unitName",
					label:'The unit name eg bottle for soda',

				},
				{
					name:"bundleName",
					label:"The name of the bundle eg crate for soda"
				},
				{
					name:"unitsPerBundle",
					min:0,
					label:"units per bundle eg 24 sodas per crate"
				}

				]);
	}

}

export default structure;