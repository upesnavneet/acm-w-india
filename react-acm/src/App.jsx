import React, { useState, useEffect } from 'react';
import Header from './components/Header';
import Footer from './components/Footer';

// Pages
import Home from './pages/Home';
import Conferences from './pages/Conferences';
import ConferenceSingle from './pages/ConferenceSingle';
import PostSingle from './pages/PostSingle';
import CustomPage from './pages/CustomPage';
import NotFound from './pages/NotFound';

// Mock Data
import { mockPosts } from './data/mockPosts';
import { mockConferences } from './data/mockConferences';

// Import the original CSS files from the theme directory directly!
// This leverages Vite's builder to load and bundle styles without copying them.
import '../../acm/acm-blessed1.css';
import '../../acm/style.css';

export default function App() {
  const [route, setRoute] = useState({ view: 'home', slug: '', query: '' });

  // Simple Hash Routing Parser
  const parseHash = () => {
    const hash = window.location.hash || '#home';

    if (hash === '#home' || hash === '#') {
      setRoute({ view: 'home', slug: '', query: '' });
    } else if (hash === '#conferences') {
      setRoute({ view: 'conferences', slug: '', query: '' });
    } else if (hash.startsWith('#post/')) {
      const slug = hash.replace('#post/', '');
      setRoute({ view: 'post', slug: slug, query: '' });
    } else if (hash.startsWith('#conference/')) {
      const slug = hash.replace('#conference/', '');
      setRoute({ view: 'conference', slug: slug, query: '' });
    } else if (hash === '#acm-w') {
      setRoute({ view: 'acm-w', slug: '', query: '' });
    } else if (hash === '#get-involved') {
      setRoute({ view: 'get-involved', slug: '', query: '' });
    } else if (hash === '#contact') {
      setRoute({ view: 'contact', slug: '', query: '' });
    } else if (hash === '#about') {
      setRoute({ view: 'about', slug: '', query: '' });
    } else if (hash === '#volunteers') {
      setRoute({ view: 'volunteers', slug: '', query: '' });
    } else if (hash === '#chapters') {
      setRoute({ view: 'chapters', slug: '', query: '' });
    } else if (hash === '#celebrations') {
      setRoute({ view: 'celebrations', slug: '', query: '' });
    } else if (hash === '#newsletter') {
      setRoute({ view: 'newsletter', slug: '', query: '' });
    } else if (hash === '#blog') {
      setRoute({ view: 'blog', slug: '', query: '' });
    } else if (hash.startsWith('#search/')) {
      const query = decodeURIComponent(hash.replace('#search/', ''));
      setRoute({ view: 'search', slug: '', query: query });
    } else {
      setRoute({ view: '404', slug: '', query: '' });
    }
  };

  useEffect(() => {
    parseHash();

    window.addEventListener('hashchange', parseHash);
    return () => window.removeEventListener('hashchange', parseHash);
  }, []);

  const navigateTo = (target) => {
    window.location.hash = target;
  };

  const handleSearch = (query) => {
    if (query.trim()) {
      navigateTo(`search/${encodeURIComponent(query.trim())}`);
    }
  };

  // Perform search locally
  const getSearchResults = (query) => {
    if (!query) return { posts: [], conferences: [] };
    const lowercaseQuery = query.toLowerCase();

    const posts = mockPosts.filter(p =>
      p.title.toLowerCase().includes(lowercaseQuery) ||
      p.excerpt.toLowerCase().includes(lowercaseQuery) ||
      p.content.toLowerCase().includes(lowercaseQuery)
    );

    const conferences = mockConferences.filter(c =>
      c.title.toLowerCase().includes(lowercaseQuery) ||
      c.description.toLowerCase().includes(lowercaseQuery) ||
      c.content.toLowerCase().includes(lowercaseQuery)
    );

    return { posts, conferences };
  };

  // Render active view
  const renderView = () => {
    const { view, slug, query } = route;

    switch (view) {
      case 'home':
        return (
          <Home
            onNavigatePost={(s) => navigateTo(`post/${s}`)}
            onNavigateConference={(s) => navigateTo(`conference/${s}`)}
            onNavigate={navigateTo}
          />
        );
      case 'conferences':
        return (
          <Conferences
            onNavigateConference={(s) => navigateTo(`conference/${s}`)}
            onNavigate={navigateTo}
          />
        );
      case 'conference':
        return (
          <ConferenceSingle
            slug={slug}
            onNavigate={navigateTo}
            onNavigateConference={(s) => navigateTo(`conference/${s}`)}
          />
        );
      case 'post':
        return (
          <PostSingle
            slug={slug}
            onNavigate={navigateTo}
          />
        );
      case 'acm-w':
      case 'get-involved':
      case 'contact':
      case 'about':
      case 'volunteers':
      case 'chapters':
      case 'celebrations':
      case 'newsletter':
      case 'blog':
        return (
          <CustomPage
            pageId={view}
            onNavigate={navigateTo}
          />
        );
      case 'search':
        const { posts, conferences } = getSearchResults(query);
        return (
          <div className="row" style={{ marginTop: '20px', minHeight: '400px' }}>
            <div className="columns small-12">
              <h1 style={{ fontSize: '28px', borderBottom: '1px solid #ddd', paddingBottom: '10px', color: '#333' }}>
                Search Results for: "{query}"
              </h1>

              {posts.length === 0 && conferences.length === 0 ? (
                <div style={{ padding: '30px 0', color: '#666' }}>
                  <p>No results found matching your query. Try searching for "ACM", "algorithms", or "symposium".</p>
                </div>
              ) : (
                <div style={{ marginTop: '20px' }}>
                  {posts.length > 0 && (
                    <div style={{ marginBottom: '30px' }}>
                      <h3 style={{ color: '#005a83', borderBottom: '2px solid #005a83', paddingBottom: '5px' }}>Articles ({posts.length})</h3>
                      <ul style={{ listStyle: 'none', padding: 0 }}>
                        {posts.map(p => (
                          <li key={p.id} style={{ marginBottom: '15px', padding: '15px', background: '#fcfcfc', border: '1px solid #eee', borderRadius: '4px' }}>
                            <a href={`#post/${p.slug}`} onClick={(e) => { e.preventDefault(); navigateTo(`post/${p.slug}`); }} style={{ fontSize: '16px', fontWeight: 'bold', color: '#005a83', textDecoration: 'none' }}>
                              {p.title}
                            </a>
                            <p style={{ margin: '5px 0 0 0', fontSize: '13px', color: '#666' }}>{p.excerpt}</p>
                          </li>
                        ))}
                      </ul>
                    </div>
                  )}

                  {conferences.length > 0 && (
                    <div>
                      <h3 style={{ color: '#005a83', borderBottom: '2px solid #005a83', paddingBottom: '5px' }}>Conferences ({conferences.length})</h3>
                      <ul style={{ listStyle: 'none', padding: 0 }}>
                        {conferences.map(c => (
                          <li key={c.id} style={{ marginBottom: '15px', padding: '15px', background: '#fcfcfc', border: '1px solid #eee', borderRadius: '4px' }}>
                            <a href={`#conference/${c.slug}`} onClick={(e) => { e.preventDefault(); navigateTo(`conference/${c.slug}`); }} style={{ fontSize: '16px', fontWeight: 'bold', color: '#005a83', textDecoration: 'none' }}>
                              {c.title}
                            </a>
                            <div style={{ fontSize: '11px', color: '#888', marginTop: '2px' }}>📍 {c.location} | 📅 {c.date}</div>
                            <p style={{ margin: '5px 0 0 0', fontSize: '13px', color: '#666' }}>{c.description}</p>
                          </li>
                        ))}
                      </ul>
                    </div>
                  )}
                </div>
              )}
            </div>
          </div>
        );
      case '404':
      default:
        return <NotFound onNavigate={navigateTo} />;
    }
  };

  return (
    <div className="app-container" style={{ minHeight: '100vh', display: 'flex', flexDirection: 'column' }}>

      {/* Centralized Header */}
      <Header
        activeTab={route.view}
        onNavigate={navigateTo}
        onSearch={handleSearch}
      />

      {/* Central View Content */}
      <main style={{ flex: '1 0 auto' }}>
        {renderView()}
      </main>

      {/* Centralized Footer */}
      <Footer onNavigate={navigateTo} />

    </div>
  );
}
