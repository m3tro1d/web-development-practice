import './styles.css';

import $ from 'jquery';


export default function handleHobbiesUpdate(btnObject) {
  const btn = $(btnObject);
  const updateInfo = $(btn.next());
  btn.click(() => {
    $.ajax({
      url: '/update',
      method: 'POST',
    })
      .done(res => {
        updateInfo.text('Success! Refresh the page to see the new images.');
      })
      .fail((jqXHR, textStatus) => {
        updateInfo.text('Oops... Something went wrong.');
      });
  });
}
