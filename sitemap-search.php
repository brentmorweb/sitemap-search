
    <link rel="preconnect" href="/">
    <link rel="dns-prefetch" href="/">


<!-- Search Trigger Button -->
<button class="search-trigger" id="search-trigger" title="Open Search (Press /)">
    <i class="fas fa-search" id="search-trigger-icon"></i>
</button>

<!-- Search Popup -->
<div class="search-popup" id="search-popup">
    <div class="search-popup-content">
        <div class="search-popup-header">
            <button class="popup-close" id="popup-close" title="Close Search (Esc)">
                <i class="fas fa-times"></i>
            </button>
            
            <div class="search-container">
                <div class="preload-status" id="preload-status"></div>
                
                <div class="search-input-wrapper">
                    <input type="text" id="site-search-input" placeholder="Loading search data..." autocomplete="off" aria-label="Search" disabled>
                    <button class="clear-button" id="clear-search" title="Clear search"><i class="fas fa-times"></i></button>
                    <span class="search-icon"><i class="fas fa-search"></i></span>
                    
                    <!-- Autocomplete Suggestions Dropdown -->
                    <div class="suggestions-dropdown" id="suggestions-dropdown"></div>
                </div>
                
                <div class="search-filters" id="search-filters">
                    <button class="filter-button active" data-filter="all">All</button>
                    <button class="filter-button" data-filter="pages">Pages</button>
                    <button class="filter-button" data-filter="images">Images</button>
                    <button class="filter-button" data-filter="blog">Blog</button>
                    <button class="filter-button" data-filter="docs">Docs</button>
                </div>
            </div>
        </div>
        
        <div class="search-popup-body">
            <div class="search-stats" id="search-stats" style="display: none;">
                <div class="results-count" id="results-count"></div>
                <div class="sort-options">
                    <label for="sort-select">Sort by:</label>
                    <select id="sort-select" class="sort-select">
                        <option value="relevance">Relevance</option>
                        <option value="title">Title</option>
                        <option value="url">URL</option>
                        <option value="size">Size</option>
                    </select>
                </div>
            </div>
            
            <div class="search-results" id="site-search-results">
                <div class="search-hint">
                    <i class="fas fa-search"></i>
                    <div>Optimized search system loading...</div>
                    <div style="margin-top: 8px; font-size: 0.8rem; opacity: 0.7;">Press <kbd>/</kbd> to quickly open search • <kbd>Esc</kbd> to close</div>
                </div>
            </div>
            <div class="pagination" id="site-search-pagination"></div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div class="image-modal" id="image-modal">
    <div class="modal-content">
        <button class="modal-close" id="modal-close"><i class="fas fa-times"></i></button>
        <img class="modal-image" id="modal-image">
        <div class="modal-info" id="modal-info"></div>
    </div>
</div>

<style>
/* Search Icon Button */
.search-trigger {
    position: fixed;
    top: 20px;
    right: 20px;
    width: 50px;
    height: 50px;
    background: #0066cc;
    border: none;
    border-radius: 50%;
    color: white;
    font-size: 1.2rem;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0, 102, 204, 0.3);
    transition: all 0.3s ease;
    z-index: 1001;
}

.search-trigger:hover {
    background: #0052a3;
    transform: scale(1.1);
    box-shadow: 0 6px 16px rgba(0, 102, 204, 0.4);
}

.search-trigger.active {
    background: #dc3545;
}

.search-trigger.active:hover {
    background: #c82333;
}

/* Search Popup */
.search-popup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(5px);
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.search-popup.show {
    opacity: 1;
    visibility: visible;
}

.search-popup-content {
    background: white;
    border-radius: 16px;
    width: 90%;
    max-width: 900px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    transform: scale(0.9) translateY(20px);
    transition: transform 0.3s ease;
}

.search-popup.show .search-popup-content {
    transform: scale(1) translateY(0);
}

.search-popup-header {
    padding: 24px 24px 0;
    border-bottom: 1px solid #e1e5e9;
    position: sticky;
    top: 0;
    background: white;
    border-radius: 16px 16px 0 0;
    z-index: 10;
}

.search-popup-body {
    padding: 0 24px 24px;
}

.search-container {
    max-width: none;
    margin: 0;
    position: relative;
}

.search-input-wrapper {
    position: relative;
    margin-bottom: 1em;
}

.search-container input {
    width: 100%;
    padding: 16px 60px 16px 20px;
    font-size: 1.1rem;
    border: 2px solid #e1e5e9;
    border-radius: 12px;
    box-sizing: border-box;
    transition: border-color 0.2s, box-shadow 0.2s;
    background: #fff;
}

.search-container input:focus {
    outline: none;
    border-color: #0066cc;
    box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
}

.search-container input:disabled {
    background: #f8f9fa;
    color: #666;
    cursor: not-allowed;
}

.search-icon {
    position: absolute;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
    color: #666;
    pointer-events: none;
    font-size: 1.1rem;
}

.clear-button {
    position: absolute;
    right: 55px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #999;
    cursor: pointer;
    padding: 8px;
    border-radius: 50%;
    display: none;
    font-size: 1rem;
}

.clear-button:hover {
    background: #f0f0f0;
    color: #666;
}

.popup-close {
    position: absolute;
    top: 24px;
    right: 24px;
    background: none;
    border: none;
    font-size: 1.5rem;
    color: #666;
    cursor: pointer;
    padding: 8px;
    border-radius: 50%;
    transition: all 0.2s;
}

.popup-close:hover {
    background: #f0f0f0;
    color: #333;
}

/* Autocomplete Suggestions */
.suggestions-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border: 1px solid #e1e5e9;
    border-top: none;
    border-radius: 0 0 12px 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    max-height: 300px;
    overflow-y: auto;
    z-index: 1000;
    display: none;
}

.suggestions-dropdown.show {
    display: block;
}

.suggestion-item {
    padding: 12px 20px;
    cursor: pointer;
    border-bottom: 1px solid #f1f3f4;
    display: flex;
    align-items: center;
    gap: 12px;
    transition: background-color 0.2s;
}

.suggestion-item:last-child {
    border-bottom: none;
}

.suggestion-item:hover,
.suggestion-item.highlighted {
    background: #f8f9fa;
}

.suggestion-icon {
    color: #666;
    width: 16px;
    text-align: center;
}

.suggestion-content {
    flex: 1;
}

.suggestion-text {
    font-weight: 500;
    color: #24292f;
}

.suggestion-context {
    font-size: 0.8rem;
    color: #656d76;
    margin-top: 2px;
}

.suggestion-fuzzy {
    opacity: 0.8;
}

.suggestion-fuzzy .suggestion-text {
    font-style: italic;
}

.suggestion-recent {
    background: #f8f9fa;
}

.suggestion-recent .suggestion-text {
    color: #6f42c1;
}

.remove-recent-btn {
    background: none;
    border: none;
    color: #999;
    cursor: pointer;
    padding: 4px 8px;
    border-radius: 3px;
    font-size: 0.8rem;
    margin-left: 8px;
    opacity: 0;
    transition: opacity 0.2s, background-color 0.2s;
}

.suggestion-item:hover .remove-recent-btn {
    opacity: 1;
}

.remove-recent-btn:hover {
    background: #e9ecef;
    color: #dc3545;
}

.clear-all-item {
    border-top: 1px solid #e1e5e9;
    background: #f8f9fa;
    color: #6c757d;
    cursor: pointer;
}

.clear-all-item:hover {
    background: #e9ecef;
}

.clear-all-item .suggestion-text {
    color: #dc3545;
    font-weight: 500;
}

.fuzzy-match {
    background: #fff3cd;
    padding: 1px 2px;
    border-radius: 2px;
}

.search-filters {
    display: flex;
    gap: 12px;
    margin-bottom: 1em;
    flex-wrap: wrap;
}

.filter-button {
    padding: 10px 18px;
    border: 1px solid #ddd;
    background: #f8f9fa;
    border-radius: 25px;
    cursor: pointer;
    font-size: 0.9rem;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    gap: 6px;
}

.filter-button.active {
    background: #0066cc;
    color: white;
    border-color: #0066cc;
}

.filter-button:hover:not(.active) {
    background: #e9ecef;
}

.search-stats {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1em;
    font-size: 0.9rem;
    color: #666;
    padding: 12px 0;
    border-bottom: 1px solid #f1f3f4;
}

.results-count {
    font-weight: 500;
}

.sort-options {
    display: flex;
    gap: 8px;
    align-items: center;
}

.sort-select {
    padding: 6px 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 0.85rem;
    background: white;
}

.search-results {
    margin-bottom: 2em;
    max-height: 60vh;
    overflow-y: auto;
}

/* Page Results */
.search-results .page-item {
    padding: 20px;
    border: 1px solid #e1e5e9;
    background: #fff;
    border-radius: 12px;
    margin-bottom: 16px;
    transition: box-shadow 0.2s, border-color 0.2s;
    position: relative;
}

.search-results .page-item:hover {
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    border-color: #d0d7de;
}

.search-results h3 {
    margin: 0 0 8px;
    font-size: 1.2rem;
    line-height: 1.3;
}

.search-results h3 a {
    color: #0066cc;
    text-decoration: none;
}

.search-results h3 a:hover {
    text-decoration: underline;
}

.result-url {
    font-size: 0.8rem;
    color: #22863a;
    margin-bottom: 8px;
    word-break: break-all;
}

.search-results p {
    margin: 0;
    color: #586069;
    line-height: 1.5;
}

/* Image Results */
.image-results-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 16px;
    margin-bottom: 16px;
}

.image-item {
    border: 1px solid #e1e5e9;
    border-radius: 12px;
    overflow: hidden;
    background: #fff;
    transition: box-shadow 0.2s, transform 0.2s;
    cursor: pointer;
}

.image-item:hover {
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    transform: translateY(-2px);
}

.image-thumbnail {
    width: 100%;
    height: 140px;
    object-fit: cover;
    background: #f8f9fa;
    display: block;
}

.image-thumbnail.loading {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0f0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: loading 1.5s infinite;
}

.image-thumbnail.error {
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #666;
    font-size: 0.8rem;
    flex-direction: column;
    gap: 8px;
}

@keyframes loading {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}

.image-info {
    padding: 12px;
}

.image-title {
    font-size: 0.9rem;
    font-weight: 500;
    margin: 0 0 4px;
    line-height: 1.3;
    color: #24292f;
}

.image-details {
    font-size: 0.75rem;
    color: #656d76;
    line-height: 1.4;
}

.search-results mark {
    background: #fff3cd;
    padding: 1px 2px;
    border-radius: 2px;
    font-weight: 500;
}

.result-score {
    position: absolute;
    top: 16px;
    right: 16px;
    background: #f1f3f4;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.75rem;
    color: #666;
}

/* Image Modal */
.image-modal {
    display: none;
    position: fixed;
    z-index: 2000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.9);
    backdrop-filter: blur(5px);
}

.image-modal.show {
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-content {
    max-width: 90vw;
    max-height: 90vh;
    position: relative;
}

.modal-image {
    max-width: 100%;
    max-height: 90vh;
    object-fit: contain;
    border-radius: 8px;
}

.modal-close {
    position: absolute;
    top: -40px;
    right: 0;
    color: white;
    font-size: 2rem;
    cursor: pointer;
    background: none;
    border: none;
    padding: 8px;
}

.modal-info {
    position: absolute;
    bottom: -60px;
    left: 0;
    right: 0;
    color: white;
    text-align: center;
    font-size: 0.9rem;
}

.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
    margin-top: 2em;
    padding-top: 1em;
    border-top: 1px solid #f1f3f4;
}

.pagination button {
    padding: 10px 18px;
    font-size: 0.9rem;
    border: 1px solid #d0d7de;
    background: #f6f8fa;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s;
}

.pagination button:hover:not(:disabled) {
    background: #0066cc;
    color: white;
    border-color: #0066cc;
}

.pagination button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.pagination .page-info {
    margin: 0 16px;
    font-size: 0.9rem;
    color: #666;
    min-width: 120px;
    text-align: center;
}

.loading {
    text-align: center;
    padding: 40px 20px;
    color: #666;
}

.loading::after {
    content: '';
    display: inline-block;
    width: 20px;
    height: 20px;
    border: 2px solid #f3f3f3;
    border-top: 2px solid #0066cc;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-left: 10px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.no-results {
    text-align: center;
    padding: 60px 20px;
    color: #666;
}

.no-results h3 {
    margin-bottom: 16px;
    color: #24292f;
}

.preload-status {
    position: absolute;
    top: -2px;
    left: 0;
    right: 0;
    height: 2px;
    background: #e1e5e9;
    border-radius: 1px;
    overflow: hidden;
    opacity: 0;
    transition: opacity 0.3s;
}

.preload-status.active {
    opacity: 1;
}

.preload-status::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, #0066cc 0%, #00cc66 50%, #0066cc 100%);
    animation: preload-progress 3s ease-in-out infinite;
}

@keyframes preload-progress {
    0% { left: -100%; }
    100% { left: 100%; }
}

/* Search hint when empty */
.search-hint {
    text-align: center;
    padding: 40px 20px;
    color: #666;
    font-size: 0.9rem;
}

.search-hint i {
    font-size: 3rem;
    color: #ddd;
    margin-bottom: 16px;
    display: block;
}

/* Loading indicators */
.search-loading {
    text-align: center;
    padding: 40px 20px;
    color: #0066cc;
    font-weight: 500;
}

.search-loading i {
    animation: spin 1s linear infinite;
    margin-right: 8px;
}

/* Responsive design */
@media (max-width: 768px) {
    .search-popup-content {

        width: 95%;
        margin: 20px;
        max-height: calc(100vh - 40px);
    }
    
    .search-popup-header,
    .search-popup-body {
        padding: 16px;
    }
    
    .search-trigger {
        top: 15px;
        right: 15px;
        width: 45px;
        height: 45px;
    }
    
    .search-container input {
        padding: 14px 50px 14px 16px;
        font-size: 1rem;
    }
    
    .search-filters {
        justify-content: center;
    }
    
    .search-stats {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }
    
    .image-results-grid {
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 12px;
    }

    .image-thumbnail {
        height: 120px;
    }
}
</style>

<script>
(function() {
    'use strict';
    
    // ============================================================================
    // DOM ELEMENTS & GLOBAL STATE
    // ============================================================================
    
    const searchTrigger = document.getElementById('search-trigger');
    const searchTriggerIcon = document.getElementById('search-trigger-icon');
    const searchPopup = document.getElementById('search-popup');
    const popupClose = document.getElementById('popup-close');
    const input = document.getElementById('site-search-input');
    const clearBtn = document.getElementById('clear-search');
    const statsEl = document.getElementById('search-stats');
    const countEl = document.getElementById('results-count');
    const resultsEl = document.getElementById('site-search-results');
    const pagingEl = document.getElementById('site-search-pagination');
    const filtersEl = document.getElementById('search-filters');
    const sortSelect = document.getElementById('sort-select');
    const imageModal = document.getElementById('image-modal');
    const modalImage = document.getElementById('modal-image');
    const modalInfo = document.getElementById('modal-info');
    const modalClose = document.getElementById('modal-close');
    const preloadStatus = document.getElementById('preload-status');
    const suggestionsDropdown = document.getElementById('suggestions-dropdown');
    
    // Global state
    const pageSize = 12;
    let pageDataCache = new Map();
    let searchIndex = new Map();
    let imageIndex = new Map();
    let lastResults = [];
    let filteredResults = [];
    let currentPage = 1;
    let currentFilter = 'all';
    let currentSort = 'relevance';
    let searchTimer;
    let suggestionTimer;
    let dataLoaded = false;
    let criticalDataLoaded = false;
    let allSearchableContent = [];
    let currentSuggestionIndex = -1;
    let suggestions = [];
    let recentSearches = [];
    let isPopupOpen = false;
    let searchCache = new Map();
    let lastQuery = '';
    let sitemapUrls = [];
    let textCache = new Map();
    
    // Configuration constants
    const maxRecentSearches = 10;
    const maxCacheSize = 200;
    // Tweaked for ~1100 page sitemap
    const maxConcurrentRequests = 80;
    const requestDelay = 2;
    const chunkSize = 150;
    const criticalPageLimit = 100;
    
    // Performance optimization constants
    const commonWords = new Set(['the', 'and', 'for', 'are', 'but', 'not', 'you', 'all', 'can', 'had', 'her', 'was', 'one', 'our', 'out', 'day', 'get', 'has', 'him', 'his', 'how', 'its', 'may', 'new', 'now', 'old', 'see', 'two', 'way', 'who', 'with', 'from', 'they', 'been', 'have', 'will', 'would', 'could', 'should', 'their', 'there', 'where', 'when', 'what', 'this', 'that']);
    const titleRegex = /<title>([\s\S]*?)<\/title>/i;
    const wordBoundaryRegex = /\b\w+\b/g;

    // ============================================================================
    // LARGE SITE OPTIMIZATION CLASS
    // ============================================================================
    
    class LargeSitePageCache {
        constructor() {
            this.loadStartTime = 0;
            this.onProgress = null;
            this.onCriticalComplete = null;
            this.processingQueue = [];
            this.isProcessing = false;
        }

        // Smart URL prioritization for large sites
        prioritizeUrls(urls) {
            const priorities = {
                homepage: 1000,
                main_sections: 900,
                docs: 800,
                blog_main: 700,
                category_pages: 600,
                recent_content: 500,
                regular_pages: 100
            };
            
            return urls.map(url => {
                let priority = priorities.regular_pages;
                const path = url.toLowerCase();
                
                // Homepage and main pages
                if (path.endsWith('/') || path.endsWith('/index.html') || path.endsWith('/index')) {
                    priority = priorities.homepage;
                }
                // Main sections
                else if (path.match(/\/(about|contact|services|products|docs|blog)$/)) {
                    priority = priorities.main_sections;
                }
                // Documentation
                else if (path.includes('/doc') || path.includes('/guide') || path.includes('/help')) {
                    priority = priorities.docs;
                }
                // Blog main pages
                else if (path.includes('/blog') && !path.match(/\/blog\/\d{4}/)) {
                    priority = priorities.blog_main;
                }
                // Category/listing pages
                else if (path.includes('/category') || path.includes('/tag') || path.includes('/archive')) {
                    priority = priorities.category_pages;
                }
                // Recent content (2023-2025)
                else if (path.match(/\/202[3-5]/)) {
                    priority = priorities.recent_content;
                }
                
                return { url, priority };
            }).sort((a, b) => b.priority - a.priority);
        }

        // Ultra-aggressive parallel loading with connection management
        async loadMegaBatch(urls, options = {}) {
            const {
                maxConcurrent = maxConcurrentRequests,
                timeout = 6000,
                retries = 1
            } = options;
            
            const results = [];
            const executing = new Set();
            const failed = [];
            
            for (let i = 0; i < urls.length; i++) {
                const url = urls[i];
                
                const fetchPromise = this.fetchWithRetry(url, { timeout, retries })
                    .then(result => {
                        executing.delete(fetchPromise);
                        return result;
                    })
                    .catch(error => {
                        executing.delete(fetchPromise);
                        failed.push({ url, error: error.message });
                        return { url, html: null, error: error.message };
                    });
                
                results.push(fetchPromise);
                executing.add(fetchPromise);
                
                // Aggressive concurrency management
                if (executing.size >= maxConcurrent) {
                    await Promise.race(executing);
                }
                
                // Micro-delay every 20 requests to prevent browser throttling
                if ((i + 1) % 20 === 0) {
                    await new Promise(resolve => setTimeout(resolve, 2));
                }
            }
            
            const finalResults = await Promise.all(results);
            
            if (failed.length > 0) {
                console.warn(`⚠️  ${failed.length} requests failed out of ${urls.length}`);
            }
            
            return finalResults.filter(result => result.html);
        }

        // Optimized fetch with connection reuse
        async fetchWithRetry(url, { timeout = 6000, retries = 1 } = {}) {
            let lastError;
            
            for (let attempt = 0; attempt <= retries; attempt++) {
                try {
                    
                    const controller = new AbortController();
                    const timeoutId = setTimeout(() => controller.abort(), timeout);
                    
                    const response = await fetch(url, {
                        signal: controller.signal,
                        priority: 'high',
                        keepalive: true,
                        mode: 'cors'
                    });
                    
                    clearTimeout(timeoutId);
                    
                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}`);
                    }
                    
                    const html = await response.text();
                    return { url, html };
                } catch (error) {
                    lastError = error;
                    if (attempt < retries) {
                        // Exponential backoff
                        await new Promise(resolve => setTimeout(resolve, Math.pow(2, attempt) * 100));
                    }
                }
            }
            
            throw lastError;
        }

        // Lightning-fast text processing with worker-like efficiency
        processPageBatch(pageBatch) {
            const processedPages = [];
            const startTime = performance.now();
            
            for (let i = 0; i < pageBatch.length; i++) {
                const { url, html } = pageBatch[i];
                
                if (!html) continue;
                
                // Check text cache first
                const htmlHash = this.simpleHash(html);
                if (textCache.has(htmlHash)) {
                    const cachedData = textCache.get(htmlHash);
                    const page = { ...cachedData, url };
                    processedPages.push(page);
                    pageDataCache.set(url, page);
                    this.indexPageFast(page);
                    continue;
                }
                
                // Ultra-fast text extraction
                const titleMatch = html.match(titleRegex);
                const title = titleMatch ? titleMatch[1].trim() : this.extractTitleFromUrl(url);
                
                // Optimized HTML cleaning
                let text = html
                    .replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, '')
                    .replace(/<style\b[^<]*(?:(?!<\/style>)<[^<]*)*<\/style>/gi, '')
                    .replace(/<(?:nav|header|footer|aside|code|pre|noscript)\b[^>]*>[\s\S]*?<\/(?:nav|header|footer|aside|code|pre|noscript)>/gi, '')
                    .replace(/<[^>]+>/g, ' ')
                    .replace(/&[a-zA-Z0-9#]+;/g, ' ')
                    .replace(/\s+/g, ' ')
                    .trim();
                
                // Fast word extraction with length filtering
                const words = text.toLowerCase().match(wordBoundaryRegex) || [];
                const searchTerms = new Set();
                
                for (let j = 0; j < words.length; j++) {
                    const word = words[j];
                    if (word.length > 3 && word.length < 20 && !commonWords.has(word)) {
                        searchTerms.add(word);
                    }
                }
                
                const page = {
                    url,
                    title,
                    text,
                    searchTerms,
                    category: getPageCategory(url),
                    type: 'page',
                    processedAt: Date.now()
                };
                
                // Cache processed text
                const textData = { title, text, searchTerms, category: page.category };
                textCache.set(htmlHash, textData);
                
                processedPages.push(page);
                pageDataCache.set(url, page);
                this.indexPageFast(page);
            }
            
            const processingTime = performance.now() - startTime;
            console.log(`⚡ Processed ${processedPages.length} pages in ${processingTime.toFixed(1)}ms`);
            
            return processedPages;
        }

        // Chunked loading with immediate search availability
        async loadAndCacheAllDataUltraFast() {
            this.loadStartTime = Date.now();
            
            try {
                // Load sitemap with timeout
                const controller = new AbortController();
                setTimeout(() => controller.abort(), 10000);
                
                const sitemapResponse = await fetch('/sitemap01.xml', { 
                    signal: controller.signal,
                });
                
                if (!sitemapResponse.ok) {
                    throw new Error(`Sitemap HTTP ${sitemapResponse.status}`);
                }
                
                const xml = await sitemapResponse.text();
                const rawUrls = extractSitemapUrlsFast(xml);

                console.log(`📋 Found ${rawUrls.length} URLs in sitemap`);
                
                // Smart prioritization
                const prioritizedUrls = this.prioritizeUrls(rawUrls);
                sitemapUrls = prioritizedUrls.map(item => item.url);
                
                // Phase 1: Critical pages (first 50 highest priority)
                console.log(`⚡ Phase 1: Loading top ${criticalPageLimit} critical pages...`);
                const criticalUrls = prioritizedUrls.slice(0, criticalPageLimit).map(item => item.url);
                
                const criticalResults = await this.loadMegaBatch(criticalUrls, {
                    maxConcurrent: 30,
                    timeout: 8000
                });
                
                this.processPageBatch(criticalResults);
                criticalDataLoaded = true;
                
                console.log(`✅ Critical pages loaded in ${Date.now() - this.loadStartTime}ms - Search ready!`);
                if (this.onCriticalComplete) this.onCriticalComplete();
                
                // Phase 2: Remaining pages in optimized chunks
                const remainingUrls = prioritizedUrls.slice(criticalPageLimit).map(item => item.url);
                const totalChunks = Math.ceil(remainingUrls.length / chunkSize);
                
                console.log(`📦 Phase 2: Loading remaining ${remainingUrls.length} pages in ${totalChunks} chunks...`);

                
                let processedCount = criticalPageLimit;
                
                for (let i = 0; i < remainingUrls.length; i += chunkSize) {
                    const chunk = remainingUrls.slice(i, i + chunkSize);
                    const chunkNumber = Math.floor(i / chunkSize) + 1;
                    
                    console.log(`📦 Processing chunk ${chunkNumber}/${totalChunks} (${chunk.length} pages)...`);
                    
                    const chunkResults = await this.loadMegaBatch(chunk, {
                        maxConcurrent: maxConcurrentRequests,
                        timeout: 5000
                    });
                    
                    // Process immediately
                    this.processPageBatch(chunkResults);
                    
                    processedCount += chunkResults.length;
                    
                    // Progress callback
                    if (this.onProgress) {
                        this.onProgress(processedCount, rawUrls.length, chunkNumber, totalChunks);
                    }
                    
                    // Minimal delay between chunks
                    if (i + chunkSize < remainingUrls.length) {
                        await new Promise(resolve => setTimeout(resolve, requestDelay));
                    }
                }
                
                // Phase 3: Background image processing and final indexing
                console.log('🖼️  Phase 3: Processing images and building autocomplete...');
                
                // Process images in background
                requestIdleCallback(() => {
                    this.processAllImagesBackground();
                });
                
                // Build autocomplete index
                buildAutocompleteIndex();
                
                const totalTime = Date.now() - this.loadStartTime;
                console.log(`✅ All ${rawUrls.length} pages loaded and indexed in ${totalTime}ms`);
                console.log(`📊 Final stats: ${pageDataCache.size} pages, ${searchIndex.size} search terms`);
                
                dataLoaded = true;
                return true;
                
            } catch (error) {
                console.error('❌ Ultra-fast loading failed:', error);
                throw error;
            }
        }

        // Background image processing for large sites
        async processAllImagesBackground() {
            console.log('🖼️  Background image processing started...');
            let imageCount = 0;
            
            for (const [url] of pageDataCache) {
                try {
                    const result = await this.fetchWithRetry(url, { timeout: 4000, retries: 0 });
                    if (result && result.html) {
                        const images = extractImagesOptimized(result.html, url);
                        imageCount += images.length;
                        images.forEach(image => indexImage(image));
                    }
                } catch (e) {
                    // ignore fetch errors for background image processing
                }

                // Process in small batches to avoid blocking
                if (imageCount % 50 === 0) {
                    await new Promise(resolve => setTimeout(resolve, 10));
                }
            }
            
            console.log(`🖼️  Processed ${imageCount} images in background`);
        }

        // Optimized helper functions
        simpleHash(str) {
            let hash = 0;
            for (let i = 0; i < str.length; i++) {
                const char = str.charCodeAt(i);
                hash = ((hash << 5) - hash) + char;
                hash = hash & hash; // Convert to 32-bit integer
            }
            return hash.toString(36);
        }

        extractTitleFromUrl(url) {
            try {
                const pathname = new URL(url).pathname;
                const segments = pathname.split('/').filter(s => s);
                const lastSegment = segments[segments.length - 1] || 'Home';
                return lastSegment.replace(/[-_]/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
            } catch (e) {
                return 'Untitled';
            }
        }

        indexPageFast(page) {
            // Batch index updates for better performance
            const terms = Array.from(page.searchTerms);
            const titleWords = page.title.toLowerCase().match(wordBoundaryRegex) || [];
            
            [...terms, ...titleWords.filter(w => w.length > 2)].forEach(term => {
                if (!searchIndex.has(term)) {
                    searchIndex.set(term, []);
                }
                searchIndex.get(term).push(page);
            });
        }
    }

    // ============================================================================
    // UTILITY FUNCTIONS
    // ============================================================================

    function normalizeUrl(u) {
        if (!u) return '';
        u = u.trim();
        
        if (u.startsWith('http://') || u.startsWith('https://')) {
            return u;
        }
        
        try {
            return new URL(u, window.location.origin).href;
        } catch (e) {
            return u;
        }
    }

    function getPageCategory(url) {
        try {
            const path = new URL(url).pathname.toLowerCase();
            if (path.includes('/blog/') || path.includes('/news/')) return 'blog';
            if (path.includes('/doc') || path.includes('/guide')) return 'docs';
            return 'pages';
        } catch (e) {
            const path = url.toLowerCase();
            if (path.includes('/blog/') || path.includes('/news/')) return 'blog';
            if (path.includes('/doc') || path.includes('/guide')) return 'docs';
            return 'pages';
        }
    }

    // Fast sitemap URL extraction using regex instead of DOM parsing
    function extractSitemapUrlsFast(xml) {
        const urls = [];
        const locRegex = /<loc>(.*?)<\/loc>/gi;
        let match;
        while ((match = locRegex.exec(xml)) !== null) {
            const url = normalizeUrl(match[1]);
            if (url) urls.push(url);
        }
        return urls;
    }

    function extractImagesOptimized(html, pageUrl) {
        const imgRegex = /<img[^>]+src\s*=\s*['"']([^'"']+)['"'][^>]*>/gi;
        const images = [];
        let match;
        
        while ((match = imgRegex.exec(html)) !== null && images.length < 20) { // Limit per page
            const src = match[1];
            const fullUrl = normalizeUrl(src);
            
            if (fullUrl && isValidImageUrl(fullUrl)) {
                const imgTag = match[0];
                const filename = extractFilename(fullUrl);
                
                if (filename && !isTinyImage(imgTag)) {
                    images.push({
                        url: fullUrl,
                        alt: extractAttribute(imgTag, 'alt') || '',
                        title: extractAttribute(imgTag, 'title') || '',
                        displayName: generateDisplayName(filename),
                        filename,
                        pageUrl,
                        type: 'image',
                        category: 'images'
                    });
                }
            }
        }
        
        return images;
    }

    function isValidImageUrl(url) {
        return /\.(jpg|jpeg|png|gif|webp|svg)(\?.*)?$/i.test(url) && !url.includes('favicon');
    }

    function extractFilename(url) {
        try {
            return new URL(url).pathname.split('/').pop().split('?')[0];
        } catch (e) {
            return null;
        }
    }

    function isTinyImage(imgTag) {
        const width = extractAttribute(imgTag, 'width');
        const height = extractAttribute(imgTag, 'height');
        return (width && parseInt(width) < 50) || (height && parseInt(height) < 50);
    }

    function extractAttribute(html, attr) {
        const match = html.match(new RegExp(`${attr}\\s*=\\s*['"']([^'"']*)['"']`, 'i'));
        return match ? match[1] : '';
    }

    function generateDisplayName(filename) {
        return filename.replace(/\.[^/.]+$/, '')
            .replace(/[_-]/g, ' ')
            .replace(/([a-z])([A-Z])/g, '$1 $2')
            .replace(/\b\w/g, l => l.toUpperCase())
            .trim() || 'Untitled Image';
    }

    function indexImage(image) {
        const searchableText = [image.alt, image.title, image.displayName, image.filename]
            .join(' ').toLowerCase();
        
        const words = searchableText.match(wordBoundaryRegex) || [];
        words.forEach(word => {
            if (word.length > 2) {
                if (!imageIndex.has(word)) {
                    imageIndex.set(word, []);
                }
                imageIndex.get(word).push(image);
            }
        });
    }

    function buildAutocompleteIndex() {
        const suggestionSet = new Set();
        
        // Add high-priority page titles first
        pageDataCache.forEach(page => {
            if (page.title.length > 2 && page.title.length < 60) {
                suggestionSet.add(page.title);
            }
        });
        
        // Add frequent search terms
        const termCounts = new Map();
        searchIndex.forEach((pages, term) => {
            if (term.length > 4 && term.length < 15 && pages.length > 2) {
                termCounts.set(term, pages.length);
            }
        });
        
        Array.from(termCounts.entries())
            .sort((a, b) => b[1] - a[1])
            .slice(0, 50)
            .forEach(([term]) => suggestionSet.add(term));
        
        allSearchableContent = Array.from(suggestionSet).slice(0, 60);
        console.log(`🔍 Built autocomplete index with ${allSearchableContent.length} suggestions`);
    }

    // ============================================================================
    // POPUP CONTROL FUNCTIONS
    // ============================================================================

    function openSearchPopup() {
        if (isPopupOpen) return;
        isPopupOpen = true;
        searchPopup.classList.add('show');
        searchTrigger.classList.add('active');
        searchTriggerIcon.className = 'fas fa-times';
        document.body.style.overflow = 'hidden';
        
        setTimeout(() => {
            if (!input.disabled) {
                input.focus();
                if (input.value.trim().length < 2) {
                    showRecentSearches();
                }
            }
        }, 150);
    }

    function closeSearchPopup() {
        if (!isPopupOpen) return;
        isPopupOpen = false;
        searchPopup.classList.remove('show');
        searchTrigger.classList.remove('active');
        searchTriggerIcon.className = 'fas fa-search';
        document.body.style.overflow = '';
        hideSuggestions();
        
        if (!lastResults.length) {
            input.value = '';
            clearBtn.style.display = 'none';
            statsEl.style.display = 'none';
            resultsEl.innerHTML = `
                <div class="search-hint">
                    <i class="fas fa-search"></i>
                    <div>Start typing to search through pages and images</div>
                    <div style="margin-top: 8px; font-size: 0.8rem; opacity: 0.7;">Press <kbd>/</kbd> to quickly open search • <kbd>Esc</kbd> to close</div>
                </div>
            `;
            pagingEl.innerHTML = '';
        }
    }

    // ============================================================================
    // RECENT SEARCHES FUNCTIONS
    // ============================================================================

    function loadRecentSearches() {
        try {
            recentSearches = recentSearches || [];
        } catch (error) {
            recentSearches = [];
        }
    }

    function saveRecentSearch(query) {
        if (!query || query.length < 2) return;
        
        const lowerQuery = query.toLowerCase();
        recentSearches = recentSearches.filter(search => search.toLowerCase() !== lowerQuery);
        recentSearches.unshift(query);
        
        if (recentSearches.length > maxRecentSearches) {
            recentSearches.length = maxRecentSearches;
        }
    }

    function clearRecentSearches() {
        recentSearches.length = 0;
        if (suggestionsDropdown.classList.contains('show')) {
            const currentQuery = input.value.trim();
            if (currentQuery.length >= 2) {
                suggestions = generateSuggestions(currentQuery);
                showSuggestions(suggestions);
            } else {
                showRecentSearches();
            }
        }
    }

    function showRecentSearches() {
        if (recentSearches.length === 0) {
            hideSuggestions();
            return;
        }
        
        const items = recentSearches.map((search, index) => 
            `<div class="suggestion-item recent-search-item" data-suggestion-index="${index}">
                <i class="fas fa-history suggestion-icon"></i>
                <div class="suggestion-content">
                    <div class="suggestion-text">${search}</div>
                    <div class="suggestion-context">Recent search</div>
                </div>
                <button class="remove-recent-btn" data-search="${search}" title="Remove from recent searches">
                    <i class="fas fa-times"></i>
                </button>
            </div>`
        );
        
        items.push(`<div class="suggestion-item clear-all-item">
            <i class="fas fa-trash suggestion-icon"></i>
            <div class="suggestion-content">
                <div class="suggestion-text">Clear all recent searches</div>
                <div class="suggestion-context">Remove search history</div>
            </div>
        </div>`);
        
        suggestionsDropdown.innerHTML = items.join('');
        suggestionsDropdown.classList.add('show');
        currentSuggestionIndex = -1;
        
        suggestions = recentSearches.map(search => ({
            text: search,
            type: 'recent',
            score: 100,
            context: 'Recent search'
        }));
    }

    // ============================================================================
    // FUZZY MATCHING FUNCTIONS
    // ============================================================================

    function levenshteinDistance(str1, str2, maxDistance = 3) {
        if (Math.abs(str1.length - str2.length) > maxDistance) return maxDistance + 1;
        
        const matrix = Array(str2.length + 1).fill(null).map(() => Array(str1.length + 1).fill(0));
        
        for (let i = 0; i <= str1.length; i++) matrix[0][i] = i;
        for (let j = 0; j <= str2.length; j++) matrix[j][0] = j;

        for (let j = 1; j <= str2.length; j++) {
            let minInRow = maxDistance + 1;
            for (let i = 1; i <= str1.length; i++) {
                const cost = str1[i - 1] === str2[j - 1] ? 0 : 1;
                matrix[j][i] = Math.min(
                    matrix[j - 1][i] + 1,
                    matrix[j][i - 1] + 1,
                    matrix[j - 1][i - 1] + cost
                );
                if (matrix[j][i] < minInRow) minInRow = matrix[j][i];
            }
            if (minInRow > maxDistance) return maxDistance + 1;
        }

        return matrix[str2.length][str1.length];
    }

    function fuzzyMatch(query, target, maxDistance = 2) {
        const queryLower = query.toLowerCase();
        const targetLower = target.toLowerCase();
        
        if (targetLower.includes(queryLower)) {
            return { score: 100, isExact: true };
        }
        
        if (query.length < 3 || target.length < 3) return null;
        
        const distance = levenshteinDistance(queryLower, targetLower, maxDistance);
        if (distance <= maxDistance) {
            const score = Math.max(0, 80 - (distance * 20));
            return { score, isExact: false, distance };
        }
        
        return null;
    }

    // ============================================================================
    // SUGGESTION FUNCTIONS
    // ============================================================================

    function generateSuggestions(query) {
        if (query.length < 2) return [];
        
        const suggestions = [];
        const queryLower = query.toLowerCase();
        const maxSuggestions = 6;
        
        // Recent searches first
        for (let i = 0; i < recentSearches.length && suggestions.length < maxSuggestions; i++) {
            if (recentSearches[i].toLowerCase().includes(queryLower)) {
                suggestions.push({
                    text: recentSearches[i],
                    type: 'recent',
                    score: 1000,
                    context: 'Recent search'
                });
            }
        }
        
        if (suggestions.length >= maxSuggestions) return suggestions;
        
        // Exact matches from pre-built index
        const exactMatches = [];
        const fuzzyMatches = [];
        const remainingSlots = maxSuggestions - suggestions.length;
        
        for (let i = 0; i < allSearchableContent.length && (exactMatches.length + fuzzyMatches.length) < remainingSlots * 2; i++) {
            const item = allSearchableContent[i];
            const itemLower = item.toLowerCase();
            
            if (suggestions.some(s => s.text.toLowerCase() === itemLower)) continue;
            
            if (itemLower.includes(queryLower)) {
                exactMatches.push({
                    text: item,
                    type: 'exact',
                    score: itemLower === queryLower ? 900 : 100,
                    context: 'Exact match'
                });
            } else if (query.length > 3 && exactMatches.length < 3) {
                const fuzzyResult = fuzzyMatch(query, item);
                if (fuzzyResult && fuzzyResult.score > 50) {
                    fuzzyMatches.push({
                        text: item,
                        type: 'fuzzy',
                        score: fuzzyResult.score,
                        context: `Did you mean "${item}"?`
                    });
                }
            }
        }
        
        suggestions.push(...exactMatches.slice(0, remainingSlots));
        if (suggestions.length < maxSuggestions) {
            suggestions.push(...fuzzyMatches.slice(0, maxSuggestions - suggestions.length));
        }
        
        return suggestions;
    }

    function showSuggestions(suggestions) {
        if (suggestions.length === 0) {
            hideSuggestions();
            return;
        }
        
        const fragment = document.createDocumentFragment();
        
        suggestions.forEach((suggestion, index) => {
            const div = document.createElement('div');
            div.className = `suggestion-item ${suggestion.type === 'recent' ? 'suggestion-recent' : suggestion.type === 'fuzzy' ? 'suggestion-fuzzy' : ''}`;
            div.dataset.suggestionIndex = index;
            
            const icon = suggestion.type === 'recent' ? 'fa-history' : suggestion.type === 'fuzzy' ? 'fa-spell-check' : 'fa-search';
            const removeBtn = suggestion.type === 'recent' 
                ? `<button class="remove-recent-btn" data-search="${suggestion.text}" title="Remove from recent searches"><i class="fas fa-times"></i></button>`
                : '';
            
            div.innerHTML = `
                <i class="fas ${icon} suggestion-icon"></i>
                <div class="suggestion-content">
                    <div class="suggestion-text">${suggestion.text}</div>
                    <div class="suggestion-context">${suggestion.context}</div>
                </div>
                ${removeBtn}
            `;
            
            fragment.appendChild(div);
        });
        
        suggestionsDropdown.innerHTML = '';
        suggestionsDropdown.appendChild(fragment);
        suggestionsDropdown.classList.add('show');
        currentSuggestionIndex = -1;
    }

    function hideSuggestions() {
        suggestionsDropdown.classList.remove('show');
        currentSuggestionIndex = -1;
    }

    function handleSuggestionNavigation(e) {
        if (!suggestionsDropdown.classList.contains('show')) return false;
        
        const suggestionItems = suggestionsDropdown.querySelectorAll('.suggestion-item');
        if (suggestionItems.length === 0) return false;
        
        if (e.key === 'ArrowDown') {
            e.preventDefault();
            currentSuggestionIndex = Math.min(currentSuggestionIndex + 1, suggestionItems.length - 1);
            updateSuggestionHighlight(suggestionItems);
            return true;
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            currentSuggestionIndex = Math.max(currentSuggestionIndex - 1, -1);
            updateSuggestionHighlight(suggestionItems);
            return true;
        } else if (e.key === 'Enter' && currentSuggestionIndex >= 0) {
            e.preventDefault();
            selectSuggestion(currentSuggestionIndex);
            return true;
        }
        
        return false;
    }

    function updateSuggestionHighlight(suggestionItems) {
        suggestionItems.forEach((item, index) => {
            item.classList.toggle('highlighted', index === currentSuggestionIndex);
        });
    }

    function selectSuggestion(index) {
        if (index < 0 || index >= suggestions.length) return;
        
        const suggestion = suggestions[index];
        input.value = suggestion.text;
        hideSuggestions();
        
        performSearch(suggestion.text);
    }

    // ============================================================================
    // SEARCH FUNCTIONS
    // ============================================================================

    function performSearch(query) {
        if (!criticalDataLoaded && !dataLoaded) {
            resultsEl.innerHTML = '<div class="search-loading"><i class="fas fa-spinner"></i>Search system loading...</div>';
            return;
        }
        
        // Check cache first
        const cacheKey = query.toLowerCase().trim();
        const isFromCache = searchCache.has(cacheKey);
        
        if (isFromCache) {
            console.log(`⚡ Using cached results for: "${query}"`);
            lastResults = searchCache.get(cacheKey);
            lastQuery = cacheKey;
            statsEl.style.display = 'flex';
            processResults();
            return;
        }
        
        console.log(`🔍 Searching for: "${query}"`);
        const startTime = Date.now();
        
        saveRecentSearch(query);
        
        const terms = query.toLowerCase().split(/\s+/).filter(t => t.length > 1);
        const pageMatches = new Map();
        const imageMatches = new Map();
        
        // Search pages using pre-built index
        terms.forEach(term => {
            if (searchIndex.has(term)) {
                searchIndex.get(term).forEach(page => {
                    if (!pageMatches.has(page.url)) {
                        pageMatches.set(page.url, { page, score: 0, exactMatches: 0, fuzzyMatches: 0 });
                    }
                    const match = pageMatches.get(page.url);
                    
                    const titleLower = page.title.toLowerCase();
                    const textLower = page.text.toLowerCase();
                    
                    const titleMatches = (titleLower.match(new RegExp(term, 'g')) || []).length;
                    const textMatches = (textLower.match(new RegExp(term, 'g')) || []).length;
                    
                    match.score += titleMatches * 10 + textMatches;
                    match.exactMatches += titleMatches + textMatches;
                });
            }
            
            // Fuzzy matches for terms longer than 3 characters
            if (term.length > 3) {
                searchIndex.forEach((pages, indexTerm) => {
                    const fuzzyResult = fuzzyMatch(term, indexTerm);
                    if (fuzzyResult && fuzzyResult.score > 60) {
                        pages.forEach(page => {
                            if (!pageMatches.has(page.url)) {
                                pageMatches.set(page.url, { page, score: 0, exactMatches: 0, fuzzyMatches: 0 });
                            }
                            const match = pageMatches.get(page.url);
                            match.score += fuzzyResult.score * 0.3;
                            match.fuzzyMatches++;
                        });
                    }
                });
            }
        });
        
        // Search images using pre-built index
        terms.forEach(term => {
            if (imageIndex.has(term)) {
                imageIndex.get(term).forEach(image => {
                    if (!imageMatches.has(image.url)) {
                        imageMatches.set(image.url, { image, score: 0, exactMatches: 0, fuzzyMatches: 0 });
                    }
                    const match = imageMatches.get(image.url);
                    match.score += 5;
                    match.exactMatches++;
                });
            }
            
            // Image fuzzy search
            if (term.length > 3) {
                imageIndex.forEach((images, indexTerm) => {
                    const fuzzyResult = fuzzyMatch(term, indexTerm);
                    if (fuzzyResult && fuzzyResult.score > 50) {
                        images.forEach(image => {
                            if (!imageMatches.has(image.url)) {
                                imageMatches.set(image.url, { image, score: 0, exactMatches: 0, fuzzyMatches: 0 });
                            }
                            const match = imageMatches.get(image.url);
                            match.score += fuzzyResult.score * 0.2;
                            match.fuzzyMatches++;
                        });
                    }
                });
            }
        });
        
        // Convert to results array
        const results = [];
        
        pageMatches.forEach(({ page, score, exactMatches, fuzzyMatches }) => {
            if (score > 0) {
                // Generate snippet efficiently
                const text = page.text;
                const firstTermIndex = text.toLowerCase().indexOf(terms[0]);
                const start = Math.max(0, firstTermIndex - 80);
                let snippet = text.substring(start, start + 200);
                
                // Highlight terms
                terms.forEach(term => {
                    const regex = new RegExp(`(${term})`, 'gi');
                    snippet = snippet.replace(regex, '<mark>$1</mark>');
                });
                
                results.push({
                    url: page.url,
                    title: page.title,
                    snippet: (start > 0 ? '...' : '') + snippet + '...',
                    score,
                    category: page.category,
                    type: 'page',
                    isFuzzy: fuzzyMatches > exactMatches
                });
            }
        });
        
        imageMatches.forEach(({ image, score, exactMatches, fuzzyMatches }) => {
            if (score > 0) {
                results.push({
                    ...image,
                    score,
                    isFuzzy: fuzzyMatches > exactMatches
                });
            }
        });
        
        lastResults = results;
        lastQuery = cacheKey;
        
        // Cache the results
        if (searchCache.size >= maxCacheSize) {
            // Remove oldest cache entry
            const firstKey = searchCache.keys().next().value;
            searchCache.delete(firstKey);
        }
        searchCache.set(cacheKey, results);
        
        const searchTime = Date.now() - startTime;
        console.log(`⚡ Search completed in ${searchTime}ms - found ${results.length} results (cached for next time)`);
        
        statsEl.style.display = 'flex';
        processResults();
    }

    function processResults() {
        filteredResults = currentFilter === 'all' 
            ? [...lastResults]
            : lastResults.filter(r => r.category === currentFilter);
        
        filteredResults.sort((a, b) => {
            switch (currentSort) {
                case 'title': 
                    const aTitle = a.title || a.displayName || a.alt || '';
                    const bTitle = b.title || b.displayName || b.alt || '';
                    return aTitle.localeCompare(bTitle);
                case 'url': return a.url.localeCompare(b.url);
                case 'size': 
                    if (a.type === 'image' && b.type === 'image') {
                        return b.filename.length - a.filename.length;
                    }
                    return b.score - a.score;
                case 'relevance':
                default: return b.score - a.score;
            }
        });
        
        currentPage = 1;
        renderPage();
    }

    // Optimized rendering with document fragments
    function renderPage() {
        const total = filteredResults.length;
        const totalPages = Math.ceil(total / pageSize) || 1;
        currentPage = Math.min(Math.max(1, currentPage), totalPages);

        const start = (currentPage - 1) * pageSize;
        const pageItems = filteredResults.slice(start, start + pageSize);

        // Update stats
        const pageCount = filteredResults.filter(r => r.type === 'page').length;
        const imageCount = filteredResults.filter(r => r.type === 'image').length;
        const fuzzyCount = filteredResults.filter(r => r.isFuzzy).length;
        
        let countText = '';
        const cacheIndicator = searchCache.has(lastQuery) && input.value.toLowerCase().trim() === lastQuery ? ' ⚡' : '';
        
        if (currentFilter === 'all') {
            countText = `${total} results found (${pageCount} pages, ${imageCount} images)${cacheIndicator}`;
            if (fuzzyCount > 0) {
                countText += ` • ${fuzzyCount} fuzzy matches`;
            }
        } else if (currentFilter === 'images') {
            countText = `${imageCount} images found${cacheIndicator}`;
            if (fuzzyCount > 0) {
                countText += ` • ${fuzzyCount} fuzzy matches`;
            }
        } else {
            countText = `${pageCount} pages found${cacheIndicator}`;
            if (fuzzyCount > 0) {
                countText += ` • ${fuzzyCount} fuzzy matches`;
            }
        }
        countEl.textContent = countText;
        
        if (!pageItems.length) {
            resultsEl.innerHTML = `
                <div class="no-results">
                    <h3>No results found</h3>
                    <p>Try adjusting your search terms or filters. Fuzzy search will help with typos!</p>
                </div>
            `;
        } else {
            const fragment = document.createDocumentFragment();
            
            // Render pages
            const pages = pageItems.filter(r => r.type === 'page');
            pages.forEach(r => {
                const div = document.createElement('div');
                div.className = 'page-item';

                const href = r.url;
                let displayUrl = r.url;
                try {
                    displayUrl = new URL(r.url).pathname;
                } catch (e) {
                    displayUrl = r.url;
                }

                const fuzzyIndicator = r.isFuzzy ? ' <i class="fas fa-spell-check" title="Fuzzy match"></i>' : '';

                div.innerHTML = `
                    <div class="result-score">${Math.round(r.score)}${fuzzyIndicator}</div>
                    <h3>
                        <a href="${href}" rel="noopener">
                            ${r.title}
                        </a>
                    </h3>
                    <div class="result-url">${displayUrl}</div>
                    <p>${r.snippet}</p>
                `;
                
                fragment.appendChild(div);
            });
            
            // Render images
            const images = pageItems.filter(r => r.type === 'image');
            if (images.length > 0) {
                const gridDiv = document.createElement('div');
                gridDiv.className = 'image-results-grid';
                
                images.forEach((image, index) => {
                    const div = document.createElement('div');
                    div.className = 'image-item';
                    div.dataset.imageIndex = start + pages.length + index;
                    
                    const displayTitle = image.displayName || image.alt || image.title || image.filename || 'Untitled Image';
                    const fuzzyIndicator = image.isFuzzy ? ' <i class="fas fa-spell-check" title="Fuzzy match" style="opacity: 0.6;"></i>' : '';
                    
                    div.innerHTML = `
                        <img class="image-thumbnail" 
                             src="${image.url}" 
                             alt="${image.alt || displayTitle}" 
                             loading="lazy"
                             onerror="this.classList.add('error'); this.style.display='flex'; this.style.alignItems='center'; this.style.justifyContent='center'; this.innerHTML='<i class=&quot;fas fa-image&quot; style=&quot;font-size: 2rem; color: #666;&quot;></i>';">
                        <div class="image-info">
                            <div class="image-title">${displayTitle}${fuzzyIndicator}</div>
                            <div class="image-details">
                                <div>From: ${new URL(image.pageUrl).pathname}</div>
                            </div>
                        </div>
                    `;
                    
                    gridDiv.appendChild(div);
                });
                
                fragment.appendChild(gridDiv);
            }
            
            resultsEl.innerHTML = '';
            resultsEl.appendChild(fragment);
        }

        renderPagination(totalPages);
    }

    function renderPagination(totalPages) {
        pagingEl.innerHTML = '';
        
        if (totalPages <= 1) return;

        const fragment = document.createDocumentFragment();

        const prevBtn = document.createElement('button');
        prevBtn.innerHTML = '<i class="fas fa-chevron-left"></i> Previous';
        prevBtn.disabled = currentPage === 1;
        prevBtn.onclick = () => { currentPage--; renderPage(); };

        const nextBtn = document.createElement('button');
        nextBtn.innerHTML = 'Next <i class="fas fa-chevron-right"></i>';
        nextBtn.disabled = currentPage === totalPages;
        nextBtn.onclick = () => { currentPage++; renderPage(); };

        const info = document.createElement('div');
        info.className = 'page-info';
        info.textContent = `Page ${currentPage} of ${totalPages}`;

        fragment.append(prevBtn, info, nextBtn);
        pagingEl.appendChild(fragment);
    }

    function showImageModal(image) {
        modalImage.src = image.url;
        modalImage.alt = image.alt || image.displayName || 'Image';
        
        const displayTitle = image.displayName || image.alt || image.title || image.filename || 'Untitled Image';
        const fuzzyIndicator = image.isFuzzy ? ' (Fuzzy match)' : '';
        
        try {
            const pagePathname = new URL(image.pageUrl).pathname;
            modalInfo.innerHTML = `
                <div><strong>${displayTitle}${fuzzyIndicator}</strong></div>
                <div>From: ${pagePathname}</div>
                <div>File: ${image.filename}</div>
            `;
        } catch (e) {
            modalInfo.innerHTML = `
                <div><strong>${displayTitle}${fuzzyIndicator}</strong></div>
                <div>From: ${image.pageUrl}</div>
                <div>File: ${image.filename}</div>
            `;
        }
        
        imageModal.classList.add('show');
    }

    function hideImageModal() {
        imageModal.classList.remove('show');
    }

    // ============================================================================
    // INITIALIZATION
    // ============================================================================

    async function initializeLargeSiteSearch() {
        const cache = new LargeSitePageCache();
        
        // Progress tracking optimized for large sites
        cache.onProgress = (processed, total, chunk, totalChunks) => {
            const percent = Math.round((processed / total) * 100);
            console.log(`⏳ Chunk ${chunk}/${totalChunks} - Overall: ${processed}/${total} (${percent}%)`);
            
            // Update progress indicator
            if (preloadStatus) {
                preloadStatus.style.width = `${percent}%`;
            }
            
            // Update search placeholder
            if (input && processed > 50) {
                input.setAttribute('placeholder', `Search ${processed}+ pages loaded - Ready!`);
            }
        };
        
        // Critical pages complete - enable search immediately
        cache.onCriticalComplete = () => {
            if (input) {
                input.setAttribute('placeholder', 'Search ready! Loading more pages in background...');
                input.disabled = false;
            }
            
            // Update the search hint
            resultsEl.innerHTML = `
                <div class="search-hint">
                    <i class="fas fa-search"></i>
                    <div>Search ready! Start typing to search through pages and images</div>
                    <div style="margin-top: 8px; font-size: 0.8rem; opacity: 0.7;">Press <kbd>/</kbd> to quickly open search • <kbd>Esc</kbd> to close</div>
                </div>
            `;
            
            console.log('🚀 Critical pages loaded - search functionality enabled!');
        };
        
        try {
            console.log('🏗️  Initializing search for large site (1000+ pages)...');
            
            // Start the ultra-fast loading
            await cache.loadAndCacheAllDataUltraFast();
            
            // Final update
            if (input) {
                input.setAttribute('placeholder', `All ${sitemapUrls.length} pages ready - Ultra-fast search!`);
            }
            
            console.log('✅ Large site search fully initialized!');
            return cache;
            
        } catch (error) {
            console.error('❌ Large site initialization failed:', error);
            throw error;
        }
    }


    // ============================================================================
    // EVENT HANDLERS
function init() {
    console.log('🚀 Ultra-optimized search initializing...');
    loadRecentSearches();


    preloadStatus.classList.add('active');
    input.setAttribute('placeholder', 'Loading search data...');
    input.disabled = true;

    initializeLargeSiteSearch()
        .then(() => {
            console.log(`🎉 Search ready with ${pageDataCache.size} pages!`);
        })
        .catch(error => {
            console.error('Large site loading failed:', error);
            input.setAttribute('placeholder', 'Search unavailable - please refresh');
            input.disabled = true;
        })
        .finally(() => {
            setTimeout(() => {
                preloadStatus.classList.remove('active');
            }, 500);
        });
}
    // ============================================================================

    searchTrigger.addEventListener('click', () => {
        if (isPopupOpen) {
            closeSearchPopup();
        } else {
            openSearchPopup();
        }
    });

    popupClose.addEventListener('click', closeSearchPopup);

    input.addEventListener('input', function() {
        const query = this.value.trim();
        
        clearBtn.style.display = query ? 'block' : 'none';
        
        clearTimeout(suggestionTimer);
        if (query.length >= 2) {
            const delay = query.length <= 4 ? 50 : 150;
            suggestionTimer = setTimeout(() => {
                suggestions = generateSuggestions(query);
                showSuggestions(suggestions);
            }, delay);
        } else {
            hideSuggestions();
        }
        
        if (query.length < 2) {
            statsEl.style.display = 'none';
            resultsEl.innerHTML = `
                <div class="search-hint">
                    <i class="fas fa-search"></i>
                    <div>Start typing to search through pages and images</div>
                    <div style="margin-top: 8px; font-size: 0.8rem; opacity: 0.7;">Press <kbd>/</kbd> to quickly open search • <kbd>Esc</kbd> to close</div>
                </div>
            `;
            pagingEl.innerHTML = '';
            return;
        }

        clearTimeout(searchTimer);
        searchTimer = setTimeout(() => {
            // Show different loading message for cached vs new searches
            const cacheKey = query.toLowerCase().trim();
            if (searchCache.has(cacheKey)) {
                resultsEl.innerHTML = '<div class="search-loading"><i class="fas fa-bolt"></i>Getting cached results...</div>';
            } else {
                resultsEl.innerHTML = '<div class="search-loading"><i class="fas fa-spinner"></i>Searching...</div>';
            }
            pagingEl.innerHTML = '';
            statsEl.style.display = 'none';
            performSearch(query);
        }, 300);
    });

    input.addEventListener('focus', function() {
        const query = this.value.trim();
        if (query.length < 2) {
            showRecentSearches();
        }
    });

    input.addEventListener('keydown', handleSuggestionNavigation);

    input.addEventListener('blur', function() {
        setTimeout(hideSuggestions, 150);
    });

    clearBtn.addEventListener('click', () => {
        input.value = '';
        input.focus();
        clearBtn.style.display = 'none';
        statsEl.style.display = 'none';
        resultsEl.innerHTML = `
            <div class="search-hint">
                <i class="fas fa-search"></i>
                <div>Start typing to search through pages and images</div>
                <div style="margin-top: 8px; font-size: 0.8rem; opacity: 0.7;">Press <kbd>/</kbd> to quickly open search • <kbd>Esc</kbd> to close</div>
            </div>
        `;
        pagingEl.innerHTML = '';
        hideSuggestions();
    });

    suggestionsDropdown.addEventListener('click', (e) => {
        if (e.target.closest('.remove-recent-btn')) {
            e.stopPropagation();
            const removeBtn = e.target.closest('.remove-recent-btn');
            const searchToRemove = removeBtn.dataset.search;
            
            recentSearches = recentSearches.filter(search => search !== searchToRemove);
            
            const currentQuery = input.value.trim();
            if (currentQuery.length >= 2) {
                suggestions = generateSuggestions(currentQuery);
                showSuggestions(suggestions);
            } else {
                showRecentSearches();
            }
            return;
        }
        
        if (e.target.closest('.clear-all-item')) {
            clearRecentSearches();
            return;
        }
        
        const suggestionItem = e.target.closest('.suggestion-item');
        if (suggestionItem && !suggestionItem.classList.contains('clear-all-item')) {
            const index = parseInt(suggestionItem.dataset.suggestionIndex);
            selectSuggestion(index);
        }
    });

    filtersEl.addEventListener('click', (e) => {
        if (e.target.classList.contains('filter-button')) {
            filtersEl.querySelectorAll('.filter-button').forEach(btn => btn.classList.remove('active'));
            e.target.classList.add('active');
            currentFilter = e.target.dataset.filter;
            processResults();
        }
    });

    sortSelect.addEventListener('change', (e) => {
        currentSort = e.target.value;
        processResults();
    });

    resultsEl.addEventListener('click', (e) => {
        const imageItem = e.target.closest('.image-item');
        if (imageItem) {
            const index = parseInt(imageItem.dataset.imageIndex);
            const image = filteredResults[index];
            if (image && image.type === 'image') {
                showImageModal(image);
            }
        }
    });

    modalClose.addEventListener('click', hideImageModal);
    imageModal.addEventListener('click', (e) => {
        if (e.target === imageModal) {
            hideImageModal();
        }
    });

    searchPopup.addEventListener('click', (e) => {
        if (e.target === searchPopup) {
            closeSearchPopup();
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === '/' && !['INPUT', 'TEXTAREA'].includes(e.target.tagName)) {
            e.preventDefault();
            openSearchPopup();
        } else if (e.key === 'Escape') {
            if (imageModal.classList.contains('show')) {
                hideImageModal();
            } else if (isPopupOpen) {
                closeSearchPopup();
            }
        }
    });

    // Initialize the search system
    init();
})();
</script>
