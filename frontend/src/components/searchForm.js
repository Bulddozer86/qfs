import React from 'react';
import { connect } from 'react-redux';
import { Control, Form } from 'react-redux-form';

class SearchForm extends React.Component {
  handleSubmit(val) {
    // Do anything you want with the form value
    console.log(val);
  }

  render() {
    return (
      <Form model="user" onSubmit={(val) => this.handleSubmit(val)}>
        <label>Your name?</label>
        <Control.text model=".name" />
        <button>Submit!</button>
      </Form>
    );
  }
}

// No need to connect()!
export default SearchForm;