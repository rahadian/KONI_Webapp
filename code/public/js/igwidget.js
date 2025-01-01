document.addEventListener('DOMContentLoaded', function() {
    let currentPage = 1;
    const postsPerPage = 6;
    const mediaSize = 309; // Size for width and height

    function showSpinner(button) {
        const spinner = document.createElement('span');
        spinner.classList.add('spinner-border', 'spinner-border-sm', 'ml-1');
        button.appendChild(spinner);
    }

    function hideSpinner(button) {
        const spinner = button.querySelector('.spinner-border');
        if (spinner) {
            spinner.remove();
        }
    }

    function fetchPosts(page) {
        const prevButton = document.getElementById('prev-page');
        const nextButton = document.getElementById('next-page');

        prevButton.disabled = true;
        nextButton.disabled = true;

        showSpinner(prevButton);
        showSpinner(nextButton);

        fetch('/ig')
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                const accessToken = data.access_token;
                const apiUrl = `https://graph.instagram.com/me/media?fields=id,caption,media_type,media_url,timestamp,username,permalink&access_token=${accessToken}`;

                return fetch(apiUrl);
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                const widgetContainer = document.getElementById('instagram-widget');

                if (!widgetContainer) {
                    throw new Error('Widget container not found');
                }

                widgetContainer.innerHTML = '';

                const startIndex = (page - 1) * postsPerPage;
                const endIndex = startIndex + postsPerPage;
                const paginatedData = data.data.slice(startIndex, endIndex);

                paginatedData.forEach(post => {
                    const postElement = document.createElement('div');
                    postElement.className = 'instagram-post';

                    let mediaElement;
                    if (post.media_type === 'IMAGE' || post.media_type === 'CAROUSEL_ALBUM') {
                        mediaElement = `<img src="${post.media_url}" alt="${post.caption}" style="width: ${mediaSize}px; height: ${mediaSize}px;">`;
                    } else if (post.media_type === 'VIDEO') {
                        mediaElement = `<video controls style="width: ${mediaSize}px; height: ${mediaSize}px;">
                                            <source src="${post.media_url}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>`;
                    }

                    // Truncate the caption to 100 characters
                    let truncatedCaption = post.caption ? post.caption.substring(0, 100) : '';
                    if (post.caption && post.caption.length > 100) {
                        truncatedCaption += '...';
                    }

                    postElement.innerHTML = `
                        <a href="${post.permalink}" target="_blank">

                            <div>
                                ${mediaElement}
                            </div>
                            <div>
                                ${truncatedCaption}
                            </div>
                            <div>
                                <small>${new Date(post.timestamp).toLocaleString()}</small>
                            </div>
                        </a>
                    `;

                    widgetContainer.appendChild(postElement);
                });

                // Update pagination buttons state
                prevButton.hidden = page === 1;
                nextButton.hidden = endIndex >= data.data.length;

                hideSpinner(prevButton);
                hideSpinner(nextButton);

                prevButton.disabled = false;
                nextButton.disabled = false;
            })
            .catch(error => console.error('Error fetching Instagram data:', error));
    }

    // Initial fetch
    fetchPosts(currentPage);

    // Pagination buttons
    document.getElementById('prev-page').addEventListener('click', function() {
        if (currentPage > 1) {
            currentPage--;
            fetchPosts(currentPage);
        }
    });

    document.getElementById('next-page').addEventListener('click', function() {
        currentPage++;
        fetchPosts(currentPage);
    });
});
