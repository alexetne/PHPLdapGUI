document.querySelectorAll('.ou-link').forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault();

        const ouDn = this.getAttribute('data-dn');

        fetch(`get_users.php?ou_dn=${encodeURIComponent(ouDn)}`)
            .then(response => response.json())
            .then(data => {
                const userList = document.getElementById('user-list');
                userList.innerHTML = '<table><tr><th>Nom</th><th>Email</th></tr>';

                data.forEach(user => {
                    userList.innerHTML += `
                        <tr>
                            <td>${user.cn}</td>
                            <td>${user.mail}</td>
                        </tr>
                    `;
                });

                userList.innerHTML += '</table>';
            });
    });
});
