import React, { useState } from 'react';
import { mockThemeMod } from '../data/mockThemeMod';
import './Header.css';

export default function Header({ activeTab, onNavigate, onSearch }) {
  const [searchQuery, setSearchQuery] = useState('');
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
  const [searchOpen, setSearchOpen] = useState(false);

  const handleSearchSubmit = (e) => {
    e.preventDefault();
    if (searchQuery.trim()) {
      onSearch(searchQuery.trim());
      setSearchQuery('');
      setSearchOpen(false);
    }
  };

  const navItems = [
    { name: 'HOME', target: 'home' },
    { name: 'ABOUT', target: 'about' },
    { name: 'VOLUNTEERS', target: 'volunteers' },
    { name: 'CHAPTERS', target: 'chapters' },
    { name: 'CELEBRATIONS', target: 'celebrations' },
    { name: 'NEWSLETTER', target: 'newsletter' },
    { name: 'BLOG', target: 'blog' },
  ];

  return (
    <header id="header" className="row">
      {/* Utilities branding area — exact WordPress markup */}
      <div className="clearfix utilities-area">
        <div className="logo-section">
          <div className="navbar-header show-for-large-up">
            <a className="navbar-brand" href="#home" onClick={(e) => { e.preventDefault(); onNavigate('home'); }}>
              <img alt="ACM Logo" height="78" className="logo" title="Home"
                src="/stock-images/logo.png" />
            </a>
          </div>
        </div>
        <div id="acm-description" className="column large-5 show-for-large-up">
          <div>

            ACM-W India supporting, celebrating, and advocating for Women in Computing
          </div>
        </div>
        <div id="ctas-and-search" className="column large-5 medium-6 no-pad-left ctas-and-search">
          <ul className="block-grid right">
            <li>
              <a href="https://www.linkedin.com/company/acmw-india/" target="_blank" rel="noreferrer">
                <span>Linkedin</span>
              </a>
            </li>
            <li>
              <a href="https://www.facebook.com/acmwindia" target="_blank" rel="noreferrer">
                <span>Facebook</span>
              </a>
            </li>
            <li>
              <a href="https://www.instagram.com/acmweurope" target="_blank" rel="noreferrer">
                <span>Instagram</span>
              </a>
            </li>
            <li className="hide-for-small" style={{ position: 'relative' }}>
              <form style={{ lineHeight: 1 }}>
                <label
                  style={{ cursor: 'pointer' }}
                  onClick={(e) => { e.preventDefault(); setSearchOpen(!searchOpen); }}
                >
                  <i className="fa fa-search" style={{ marginRight: '0.5em' }}></i>
                  <input
                    type="button"
                    value="Search"
                    style={{
                      fontFamily: 'inherit', fontWeight: 400, fontSize: 'inherit',
                      color: '#fff', border: 'none', background: 'none',
                      margin: 0, padding: 0, outline: 0, cursor: 'pointer'
                    }}
                  />
                </label>
              </form>
              {searchOpen && (
                <div className="search-dropdown" onClick={(e) => e.stopPropagation()}>
                  <form onSubmit={handleSearchSubmit} className="search-form">
                    <input
                      type="text"
                      placeholder="Search articles..."
                      value={searchQuery}
                      onChange={(e) => setSearchQuery(e.target.value)}
                      className="search-input"
                      autoFocus
                    />
                  </form>
                </div>
              )}
            </li>
          </ul>
        </div>
      </div>

      {/* Main Navigation Bar */}
      <nav className={`top-bar main-nav ${mobileMenuOpen ? 'expanded' : ''}`} data-topbar>
        <div className="main-nav-inner">
          <ul className="title-area show-for-small-only mobile-menu-bar">
            <li className="name mobile-menu-label">
              MENU
            </li>
            <li className="toggle-topbar menu-icon mobile-menu-toggle">
              <a
                href="#/"
                onClick={(e) => { e.preventDefault(); setMobileMenuOpen(!mobileMenuOpen); }}
                aria-label="Toggle Menu"
              >
                <span></span>
              </a>
            </li>
          </ul>

          <section className="top-bar-section">
            {/* Primary Nav Menu */}
            <ul className={`nav-menu ${mobileMenuOpen ? 'mobile-open' : 'mobile-closed'}`} id="primary-menu">
              {navItems.map((item) => {
                const isActive = activeTab === item.target;
                return (
                  <li key={item.target} className="nav-item menu-item">
                    <a
                      href={`#${item.target}`}
                      onClick={(e) => {
                        e.preventDefault();
                        onNavigate(item.target);
                        setMobileMenuOpen(false);
                      }}
                      className={`nav-link ${isActive ? 'active' : ''}`}
                    >
                      {item.name}
                    </a>
                  </li>
                );
              })}
            </ul>
          </section>
        </div>
      </nav>
    </header>
  );
}
