import React from 'react';
import Banner from '../components/Banner';
import Breadcrumbs from '../components/Breadcrumbs';
import ArticleCard from '../components/ArticleCard';
import Sidebar from '../components/Sidebar';
import { mockPosts } from '../data/mockPosts';

export default function Home({ onNavigatePost, onNavigateConference, onNavigate }) {
  return (
    <div>
      {/* Dynamic Hero Banner */}
      <Banner />

      {/* Breadcrumb container */}
      <Breadcrumbs paths={[]} onNavigate={onNavigate} />

      {/* Main Content Area */}
      <div className="article" id="maincontent" style={{ marginTop: '20px' }}>
        <article className="has-edit-button columns" id="SkipTarget" tabIndex="-1">
          <div className="row">
            
            {/* Primary News Feed (2 Columns Grid in a 9-Col container) */}
            <div className="columns large-9 medium-9 small-12 zone-1" style={{ paddingRight: '20px' }}>
              <h2 style={{ fontSize: '24px', color: '#333', borderBottom: '1px solid #ddd', paddingBottom: '10px', marginBottom: '20px' }}>
                Featured News & Articles
              </h2>
              
              <div className="articles">
                <div className="three-cols article-block">
                  <div className="row">
                    {mockPosts.map((post) => (
                      <ArticleCard 
                        key={post.id} 
                        post={post} 
                        onNavigatePost={onNavigatePost} 
                      />
                    ))}
                  </div>
                </div>
              </div>
            </div>

            {/* Sidebar Widget Area */}
            <Sidebar 
              onNavigatePost={onNavigatePost} 
              onNavigateConference={onNavigateConference} 
            />

          </div>
        </article>
      </div>
    </div>
  );
}
