function emptyDocsDown() {
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: 'Dokumen tidak tersedia',
    })
}

function openChat() {
    let chatbox = document.querySelector("#chatbox");
    chatbox.scrollTop = chatbox.scrollHeight;
}