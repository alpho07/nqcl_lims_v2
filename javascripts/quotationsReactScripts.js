'use strict';

//when no JSX, shortcut for creating an element
const e = React.createElement;

//when no JSX, shortcut for cloning an element
const c = React.cloneElement;

//Fetch all notes via fetch/axios in json
const notes = [
	{id:'1',note:'The cost of analysis may change based on the actual procedures employed in sample analysis.'},
	{id:'2',note:'For all compendial products, we shall carry out analysis using official monographs.'}
];


//Add Element Button
class NoteButton extends React.Component{

	render() {
		//console.log(this.props);
		return e('button', {class:this.props.buttonClass}, this.props.buttonAction);
	}
}


//Textarea Component
class NoteText extends React.Component{
	render(){
		return e('textarea',{class:'textarea'});
	}
}




//Add Full Note
class FullNote extends React.Component{
	render(){
		return e('div',{class:'field'},
			e('div',{class:'control'},
				e(NoteText,{class:'textarea'})
			   ,e(NoteButton, {buttonClass:'button is-danger', buttonAction:'Remove'})
			)
		)
	}	
}  


//Holds all Notes 
class NotesContainer extends React.Component{

	//Fetch Notes

	render(){

		//array to hold notes
		const noteItems = [];

		//loop through notes and assign them to noteItems
		this.props.notes.forEach((note)=>{
			noteItems.push(e(FullNote,{key:note.id, text:note.note}))
		});

		console.log(noteItems);

		//return div with all notes
		return(
			e('div',{class:''},
				e('div',null, noteItems)
			)
		)

	}
}




//Get selector to which react app will be attached.
const domContainer = document.querySelector('#quotation_notes');
ReactDOM.render(e(NotesContainer,{notes:notes}), domContainer);