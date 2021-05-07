import './styles.css'

import $ from 'jquery';


export default function handleKeywordUpdate(btnObject) {
  const btn = $(btnObject);
  const updateInfo = $(btn.next());
  const keyword = getKeyword(btn);
  btn.click(() => {
    $.ajax({
      url: `/update?keyword=${keyword}`,
      method: 'POST',
    })
      .done(res => {
        updateInfo.text(`Successfully updated "${keyword}"! Refresh the page to see the new images.`);
      })
      .fail((jqXHR, textStatus) => {
        updateInfo.text(`Something went wrong while updating "${keyword}"...`);
      });
  });
}

function getKeyword(btn) {
  const text = btn.text();
  const startPos = text.indexOf('"');
  const endPos = text.lastIndexOf('"');
  return text.slice(startPos + 1, endPos);
}
