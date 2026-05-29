import React from 'react';

export default function Breadcrumbs({ paths, onNavigate }) {
  return (
    <div className="row breadcrumb-container" style={{ margin: '15px 0' }}>
      <div className="columns small-12">
        <ul className="breadcrumbs" style={{ display: 'flex', listStyle: 'none', padding: 0, margin: 0, fontSize: '13px', gap: '5px' }}>
          <li>
            <a 
              href="#home" 
              onClick={(e) => { e.preventDefault(); onNavigate('home'); }}
              style={{ color: '#005a83', textDecoration: 'none' }}
            >
              Home
            </a>
          </li>
          
          {paths && paths.map((path, index) => {
            const isLast = index === paths.length - 1;
            return (
              <React.Fragment key={index}>
                <span className="separator" style={{ color: '#999', margin: '0 5px' }}>/</span>
                <li style={{ color: isLast ? '#333' : '#005a83' }}>
                  {isLast ? (
                    <span style={{ fontWeight: '500' }}>{path.name}</span>
                  ) : (
                    <a 
                      href={`#${path.target}`} 
                      onClick={(e) => { e.preventDefault(); onNavigate(path.target); }}
                      style={{ color: '#005a83', textDecoration: 'none' }}
                    >
                      {path.name}
                    </a>
                  )}
                </li>
              </React.Fragment>
            );
          })}
        </ul>
      </div>
    </div>
  );
}
