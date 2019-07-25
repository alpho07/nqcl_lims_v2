'use strict';

//when no JSX, shortcut for creating an element
const e = React.createElement;

//when no JSX, shortcut for cloning an element
const c = React.cloneElement;

//Add Element Button
class NoteButton extends React.Component{

	render() {
		console.log(this.props);
		return e('button', {class:this.props.buttonClass}, this.props.buttonAction);
	}
}

class FullNote extends React.Component{
	render(){
		return e(
			NoteButton, {buttonAction:'Remove', buttonClass:' button is-danger'}
		)
	}	
}  




//Get selector to which react app will be attached.
const domContainer = document.querySelector('#quotation_notes');
ReactDOM.render(e(FullNote), domContainer);