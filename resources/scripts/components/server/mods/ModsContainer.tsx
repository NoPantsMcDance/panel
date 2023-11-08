import React, { useState, useEffect, useRef } from 'react';
import installMcMods from '@/api/server/mcmods/installMcMods';
import { ServerContext } from '@/state/server';
import '@/components/server/mods/ModsStyle.css';
import defaultImage from '@/components/server/mods/mod-default.png';
import Spinner from '@/components/elements/Spinner';
import styled from 'styled-components';

interface Mod {
  modid: number;
  assetid: number;
  name: string;
  logo: string | null;
  // other properties...
}

const Overlay = styled.div`
    position: fixed; 
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5); // Semi-transparent black
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000; // Ensure the overlay is above all other UI elements
`;

function ModsList() {
  const [search, setSearch] = useState('');
  const [mods, setMods] = useState<Mod[]>([]);
  const [sortBy, setSortBy] = useState('downloads'); // default sort order
  const [installing, setInstalling] = useState(false); // State to handle installation status
  const [limit] = useState(18);
  const [hasSearched, setHasSearched] = useState(false);

  // Assuming you have the server's UUID available. If not, you need to retrieve it.
  const uuid = ServerContext.useStoreState((state) => state.server.data!.uuid);

  const [isLoading, setIsLoading] = useState(false);
  const [hasMore, setHasMore] = useState(true);
  const pageRef = useRef(1);  // Using useRef to hold the page number

  const fetchData = async (orderBy: string) => {
    setIsLoading(true);
    try {
      const response = await fetch(`https://vsmods.suhosting.net/api/mods?orderby=${orderBy}&search=${search}&page=${pageRef.current}&limit=${limit}`);
      const data = await response.json();
      setMods((prevMods) => (pageRef.current === 1 ? data.data : [...prevMods, ...data.data]));
      setHasMore(data.currentPage < data.totalPages);
      setHasSearched(true); // Add this line
    } catch (error) {
      console.error('Error fetching data: ', error);
    } finally {
      setIsLoading(false);
    }
  };

  useEffect(() => {
    pageRef.current = 1;
    fetchData(sortBy);
  }, [search]);

  useEffect(() => {
    fetchData(sortBy);
  }, [sortBy, limit]);

  const handleScroll = () => {
    const pixelsFromBottom = 300; // Adjust this value as per your need

    if (
      document.documentElement.scrollHeight - window.innerHeight <=
      document.documentElement.scrollTop + pixelsFromBottom
      && !isLoading
      && hasMore
    ) {
      pageRef.current += 1;
      fetchData(sortBy);
    }
  };

  useEffect(() => {
    window.addEventListener('scroll', handleScroll);
    return () => {
      window.removeEventListener('scroll', handleScroll);
    };
  }, [isLoading, hasMore]);

  const handleSortChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
    const newOrderBy = e.target.value;
    setSortBy(newOrderBy);
    pageRef.current = 1;
    setMods([]);
    fetchData(newOrderBy);
  };

  const getLogoUrl = (logo: string) => {
    return `https://mods.vintagestory.at/${logo}`;
  };

    const updateModCache = async (modid : number) => {
      try {
          const response = await fetch('https://vsmods.suhosting.net/api/updateMod', {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json',
              },
              body: JSON.stringify({ modid }),
          });

          if (response.ok) {
              const data = await response.json();
              console.log(data.message);
          } else {
              console.error('Failed to update mod cache');
          }
      } catch (error) {
          console.error('Error updating cache:', error);
      }
  };

  const handleLogoClick = async (mod: Mod) => {
    if (!mod || !mod.name || !mod.modid) {
      console.error('Mod, mod.name, or mod.modid is undefined');
      return;
    }
    
    console.log('Logo clicked for mod:', mod.name);
    const userConfirmed = window.confirm(`Do you want to download and install the mod: ${mod.name}`);
    
    if (userConfirmed) {
      setInstalling(true);
    
      try {
        await updateModCache(mod.modid);
        const response = await fetch(`https://vsmods.suhosting.net/api/mod/${mod.modid}`);
        const data = await response.json();
        
        console.log('Received data:', data);
        
        if (data && data.modInfo && data.releases) {
          if (data.releases.length > 0) {
            const fileid = data.releases[0].fileid;
            const modUrl = `https://mods.vintagestory.at/download?fileid=${fileid}`;
    
            console.log('Initiating mod installation for', data.modInfo.name); // Changed data.mod.name to data.modInfo.name
            
            await installMcMods(uuid, modUrl);
            console.log('Mod installation successful');
            alert('Mod installed successfully!');
            setInstalling(false);
          } else {
            console.error('No releases available for mod:', mod.name);
            alert('No releases available for this mod!');
            setInstalling(false);
          }
        } else {
          console.error('Data, modInfo or releases is/are undefined:', data);
          alert('An error occurred.');
          setInstalling(false);
        }
      } catch (error) {
        console.error('Failed to fetch mod data or install mod:', error);
        alert('Failed to install mod!');
        setInstalling(false);
      }
    }
  };
  function clearText() {
    setSearch(''); // This is the React way of clearing the input
  }

  return (
    <div>
      <h1>Mods</h1>
      {/* Dropdown to select sort order */}
      <div className="controls-container">
          <select value={sortBy} onChange={handleSortChange}>
              <option value="assetid">Date Created</option>
              <option value="lastreleased">Last Released</option>
              <option value="downloads">Downloads</option>
              <option value="follows">Follows</option>
              <option value="comments">Comments</option>
              <option value="trendingpoints">Trending Points</option>
          </select>
          <div className="input-wrapper">
            <input
                type="text"
                placeholder="Search for mods..."
                value={search}
                onChange={(e) => setSearch(e.target.value)}
                className="search-input"
            />
            <span 
                className="clear-text" 
                onClick={clearText} 
                style={{ visibility: search ? 'visible' : 'hidden' }} // This line ensures the "x" is only visible when there's text
            >
                x
            </span>
        </div>
      </div>

      {/* Conditional Rendering of the Loading Spinner */}
      {installing && (
        <Overlay>
          <Spinner size={Spinner.Size.LARGE} />
        </Overlay>
      )}

      {mods.length > 0 ? (
        <div className="mods-container"> {/* Add this div to style your mods in a grid */}
          {mods.map((mod) => (
            <div key={mod.modid} className="Mods-list"> {/* Changed li to div */}
              {mod.logo ? (
                <button className="Mods-list-button" onClick={() => handleLogoClick(mod)} disabled={installing}>
                  <img className="Mods-list-image" src={getLogoUrl(mod.logo)} alt={`Download ${mod.name}`} style={{ cursor: 'pointer' }} />
                </button>
              ) : (
                <button className="Mods-list-button" onClick={() => handleLogoClick(mod)} disabled={installing}>
                  <img className="Mods-list-image" src={defaultImage} alt={`Download ${mod.name}`} style={{ cursor: 'pointer' }} />
                </button>
              )}
              <h2 className="Mods-list-title">{mod.name}</h2>
              <div className="button-container">
                <a
                  href={`https://mods.vintagestory.at/show/mod/${mod.assetid}`}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="mod-button info-button"
                >
                  ModInfo
                </a>
                <button className="mod-button install-button" onClick={() => handleLogoClick(mod)} disabled={installing}>
                  Install Mod
                </button>
              </div>
            </div>
          ))}
        </div>
      ) : hasSearched && !isLoading ? (
        <p>No results found for "{search}".</p>
      ) : (
        <p><Spinner size={Spinner.Size.LARGE} /></p>
      )}
      {isLoading && <p>Loading more mods...</p>}
      {!hasMore && <p>You've reached the end of the list!</p>}
    </div>
  );
}

export default ModsList;